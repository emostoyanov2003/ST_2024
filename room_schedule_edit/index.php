<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel | Редактиране на резервация</title>
    <link rel="stylesheet" href="../Style_admin.css">
    <link rel="stylesheet" href="http://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" href="../admin_images/logo.png">
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src='http://kit.fontawesome.com/a076d05399.js'></script>        
    <link rel="preconnect" href="http://fonts.googleapis.com">
    <link rel="preconnect" href="http://fonts.gstatic.com" crossorigin>
    <link href="http://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css2?family=Comfortaa:wght@500&family=Jost:wght@200;300&family=M+PLUS+1p:wght@100&family=Sawarabi+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        function CloseAllDropdowns() {
            input_dropdawns = document.getElementsByClassName("input_dropdawn");
            for (var i = 0; i < input_dropdawns.length; i++) {
                input_dropdawns[i].style.display = "none";
            }
        }
    </script>
</head>
<body>
    <?php
        include "../connection.php";
        include "../admin_menu.php";
    ?>
    <div class="admin_page_container">
        <p class="admin_page_label">Редактиране на резервация</p>
        <?php
            error_reporting(0);
            $id = $_GET["id"];
            $room_id = $_GET["room_id"];
            $sqlSelectRow= "SELECT * FROM `rooms` WHERE MD5(`id`) = '$room_id'";
            $resultSelectRow = $conn -> query($sqlSelectRow);
            if (mysqli_num_rows($resultSelectRow) == 0){
                echo "
                    <script>
                        window.location.assign('../error_page/');
                    </script>
                ";
            }
            $rowSelectRow = $resultSelectRow -> fetch_assoc();
            $room_number = $rowSelectRow['room_number'];
            $room_name = $rowSelectRow['room_name'];
            $block = $rowSelectRow['block'];
            
            $owner_id = $_COOKIE["admin_panel_user_id"];
            $sqlSelectRow= "SELECT * FROM `room_schedule` WHERE MD5(`id`) = '$id' AND `owner_id` = '$owner_id'";
            $resultSelectRow = $conn -> query($sqlSelectRow);
            if (mysqli_num_rows($resultSelectRow) == 0){
                echo "
                    <script>
                        window.location.assign('../error_page/');
                    </script>
                ";
            }
            $rowSelectRow = $resultSelectRow -> fetch_assoc();
            $event_name = $rowSelectRow["event_name"];
            $date = $rowSelectRow["date"];
            $schedule_id = $rowSelectRow["schedule_id"];
            $sqlSelectHour = "SELECT `number_hour`, `start_hour`, `end_hour`  FROM `schedule` WHERE `id` = '$schedule_id' ORDER BY `id` DESC";
            $resultSelectHour = $conn -> query($sqlSelectHour);
            $rowSelectHour = $resultSelectHour->fetch_assoc();
            $number_hour = $rowSelectHour["number_hour"];
            $start_hour = $rowSelectHour["start_hour"];
            $end_hour = $rowSelectHour["end_hour"];
            echo '
                <form method="post" enctype="multipart/form-data">
                    <input type="text" name="event_name" id="event_name" class="universal_input" placeholder="Какво ще се провжда?" autocomplete="off" value="' . $event_name . '">
                    <p id="err_p1" class="err_p"></p>
                    <label for="date_time" class="universal_label">Резервиране на ' . $room_number . ' ' . $room_name . ' в блок ' . $block . ' за:</label>
                    <div id="date_specific_input">
                        <label for="date" class="universal_label">Дата:</label>
                        <input type="date" id="date" name="date" class="universal_date_input" value="' . $date . '">
                    </div>
                    <p id="err_p2" class="err_p"></p>

                    <label for="hour_time" class="universal_label">За:</label>
                    <div id="hour_specific_input">
                        <div type="text" id="hour_specific_btn" class="input_dropdawn_fake_input" onclick="showHourDropdown();" style="color: #333;">Час ' . $number_hour . ' от ' . $start_hour . ' до ' . $end_hour . '</div>
                        <input type="text" name="hour_specific" id="hour_specific" class="hidden_input" value="Час ' . $number_hour . ' от ' . $start_hour . ' до ' . $end_hour . '">
                        <div id="hour_specific_dropdown" class="input_dropdawn">';
                            $sqlSelectHours = "SELECT * FROM `schedule` WHERE `id` < '15'";
                            $resultSelectHours = $conn -> query($sqlSelectHours);
                            while($rowSelectHours = $resultSelectHours->fetch_assoc()){
                                $number_hour = $rowSelectHours["number_hour"];
                                $start_hour = $rowSelectHours["start_hour"];
                                $end_hour = $rowSelectHours["end_hour"];
                                echo '
                                    <div class="input_dropdawn_btn" onclick="assignValueHour(this.innerHTML)">Час ' . $number_hour . ' от ' . $start_hour . ' до ' . $end_hour . '</div>
                                ';	
                            }
                        echo '
                        </div>
                        <script>
                            var hour_specific = document.getElementById(\'hour_specific\');
                            var hour_specific_dropdown = document.getElementById(\'hour_specific_dropdown\');
                            var hour_specific_btn = document.getElementById(\'hour_specific_btn\');
                            function showHourDropdown(){
                                CloseAllDropdowns();
                                hour_specific_dropdown.style.display = "block";
                            }
                            function hideHourDropdown(){
                                hour_specific_dropdown.style.display = "none";
                            }
                            function assignValueHour(value){
                                hour_specific_dropdown.style.display = "none";
                                hour_specific_btn.style.color = "black";
                                hour_specific_btn.innerHTML = value;
                                hour_specific.value = value;
                            }
                        </script>
                    </div>
                    <p id="err_p3" class="err_p"></p>
                    <p id="err_p4" class="err_p"></p>
                    <input type="submit" name="submit" class="universal_submit_btn" value="Добави резервация">
                </form>
            ';
            $owner_id = $_COOKIE["admin_panel_user_id"];
            $event_name = preg_replace('/[^A-Za-zА-Яа-я0-9\-] ./u', '', $_POST["event_name"]); // Removes special chars.
            $date = $_POST["date"];
            $hour_specific = $_POST["hour_specific"];
            $current_date = date("Y-m-d");
            $dateCheck = false;
            if($date > $current_date){
                $dateCheck = true;
            }
            if(isset($_POST["submit"]) && $dateCheck == true && $event_name != "" &&  $date != "" && $hour_specific != "" && $date > $current_date){
                if($date != ""){
                    $start_date = $date;
                    $end_date = $date;
                }
                if($hour_specific != ""){
                    $start_hour = $hour_specific;
                    $end_hour = $hour_specific;
                }
                $change_location = true;
                $start = new DateTime($date);
                $end = new DateTime($date);
                // otherwise the  end date is excluded (bug?)
                $end->modify('+1 day');

                $interval = $end->diff($start);

                // total days
                $days = $interval->days;

                // create an iterateable period of date (P1D equates to 1 day)
                $period = new DatePeriod($start, new DateInterval('P1D'), $end);

                // best stored as array, so you can add more than one
                $holidays[] = null;
                $sqlSelectHolidays = "SELECT * FROM `holidays`";
                $resultSelectHolidays = $conn -> query($sqlSelectHolidays);
                while($rowSelectHolidays = $resultSelectHolidays->fetch_assoc())
                {
                    $holidays[] = $rowSelectHolidays["date"];
                }

                foreach($period as $dt) {
                    $curr = $dt->format('D');
                    if (in_array($dt->format('Y-m-d'), $holidays) == false && $curr != 'Sat' && $curr != 'Sun') {
                        $shedule_base = 0;
                        if($curr == "Tue"){
                            $shedule_base += 14;
                        }
                        else if($curr == "Wed"){
                            $shedule_base += 28;
                        }
                        else if($curr == "Thu"){
                            $shedule_base += 42;
                        }
                        else if($curr == "Fri"){
                            $shedule_base += 56;
                        }
                        $schedule_id_new = intval(str_replace(" ", "", substr($hour_specific, 6, 3))) + $shedule_base;
                        $date=$dt->format('Y-m-d');
                        $sqlInsert = "INSERT INTO `room_schedule` (`id`, `room_id`, `event_name`, `date`, `schedule_id`, `owner_id`, `added_date`)
                        SELECT NULL, '$room_id', '$event_name', '$date', '$schedule_id_new', '$owner_id', CURRENT_TIMESTAMP()
                        FROM DUAL  
                        WHERE NOT EXISTS (
                            SELECT * FROM `room_schedule` 
                            WHERE `event_name` = '$event_name' AND `date` = '$date' AND `schedule_id` = '$schedule_id_new' AND `id` = '$room_id'
                        ) 
                        LIMIT 1";
                        if($conn->query($sqlInsert) === TRUE) {
                            if (mysqli_affected_rows($conn) > 0) {
                                $sqlDelete = "DELETE FROM `room_schedule` WHERE MD5(`id`) = '$id'";
                                $conn->query($sqlDelete);
                                $change_location = true;
                            } else {
                                $change_location = false;
                                echo '
                                <script>
                                    document.getElementById("err_p4").innerHTML = "*Вече е създадена заявка, в която присъстват избраните часове или част от тях";
                                    document.getElementById("err_p4").style.display = "block";
                                </script>
                                ';
                            }
                        }
                    }
                }
                if($change_location) {
                    echo "
                        <script>
                            window.location.assign('../room_schedule/?room_id=".$room_id."');
                        </script>
                    ";
                }
            }
            if(isset($_POST["submit"])){
                if($event_name == "" || strlen($event_name) < 8){
                    echo '
                    <script>
                        document.getElementById("err_p1").innerHTML = "*Въведете име на събитието с поне 8 символа";
                        document.getElementById("err_p1").style.display = "block";
                    </script>
                    ';
                }
                if(!($date == "" && $day != "" && $start_date != "" && $end_date != "" || $date != "" && $day == "" && $start_date == "" && $end_date == "" || $dateCheck == true)){
                    echo '
                    <script>
                        document.getElementById("err_p2").innerHTML = "*Грешно въведени данни за времевия период на резервацията";
                        document.getElementById("err_p2").style.display = "block";
                    </script>
                    ';
                }
                if(!($hour == "" && $start_hour != "" && $end_hour != "" || $hour_specific != "" && $start_hour == "" && $end_hour == "")){
                    echo '
                    <script>
                        document.getElementById("err_p3").innerHTML = "*Грешно въведени данни за часовия период на резервацията";
                        document.getElementById("err_p3").style.display = "block";
                    </script>
                    ';
                }
            }
        ?>
    </div>
    <?php include "../user_colors.php";?>
</body>
</html>