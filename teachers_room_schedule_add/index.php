<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel | Добавяне на резервация</title>
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
        <p class="admin_page_label">Добавяне на резервация</p>
        <?php
            error_reporting(1);
            echo '
                <form method="post" enctype="multipart/form-data">
                    <input type="text" name="event_name" id="event_name" class="universal_input" placeholder="Какво ще се провжда?" autocomplete="off">
                    <p id="err_p1" class="err_p"></p>
                    <label for="date_time" class="universal_label">Резервиране на учителската зала за:</label>
                    <div class="radio-button-container">
                        <div class="radio-button">
                            <input type="radio" class="radio-button_input" id="date_specific" name="date_time" onclick="showDateSpecificInput()">
                            <label class="radio-button_label" for="date_specific">
                                <span class="radio-button_custom"></span>
                                Конкретена дата
                            </label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" class="radio-button_input" id="date_period" name="date_time" onclick="showDatePeriodInput()">
                            <label class="radio-button_label" for="date_period">
                                <span class="radio-button_custom"></span>
                                Период от време
                            </label>
                        </div>
                    </div>
                    <div id="date_specific_input" style="display: none;">
                        <label for="date" class="universal_label">Дата:</label>
                        <input type="date" id="date" name="date" class="universal_date_input">
                    </div>
                    <div id="date_period_input" style="display: none;">
                        <label for="start_date" class="universal_label">Начална дата:</label>
                        <input type="date" id="start_date" name="start_date" class="universal_date_input">
                        <label for="end_date" class="universal_label">Крайна дата:</label>
                        <input type="date" id="end_date" name="end_date" class="universal_date_input">
                    </div>
                    <script>
                        function showDateSpecificInput(){
                            document.getElementById("start_date").value = "";
                            document.getElementById("end_date").value = "";
                            document.getElementById("date_period_input").style.display="none";
                            document.getElementById("date_specific_input").style.display="block";
                        }
                        function showDatePeriodInput(){
                            document.getElementById("date").value = "";
                            document.getElementById("date_specific_input").style.display="none";
                            document.getElementById("date_period_input").style.display="block";
                        }
                    </script>
                    <p id="err_p3" class="err_p"></p>

                    <label for="hour_time" class="universal_label">По време на:</label>
                    <div class="radio-button-container">
                        <div class="radio-button">
                            <input type="radio" class="radio-button_input" id="hour_specific" name="hour_time" onclick="showHourSpecificInput()">
                            <label class="radio-button_label" for="hour_specific">
                                <span class="radio-button_custom"></span>
                                Конкретен час
                            </label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" class="radio-button_input" id="hour_period" name="hour_time" onclick="showHourPeriodInput()">
                            <label class="radio-button_label" for="hour_period">
                                <span class="radio-button_custom"></span>
                                Период от часове
                            </label>
                        </div>
                    </div>
                    <div id="hour_specific_input" style="display: none;">
                        <div type="text" id="hour_specific_btn" class="input_dropdawn_fake_input" onclick="showHourDropdown();">Час</div>
                        <input type="text" name="hour" id="hour" class="hidden_input">
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
                                hour_start_period_btn.innerHTML = "Начален час";
                                hour_start_period.value = "";
                                hour_end_period_btn.innerHTML = "Краен час";
                                hour_end_period.value = "";

                                hour_specific_dropdown.style.display = "none";
                                hour_specific_btn.style.color = "black";
                                hour_specific_btn.innerHTML = value;
                                hour_specific.value = value;
                            }
                        </script>
                    </div>
                    <div id="hour_period_input" style="display: none;">
                        <label for="hour_start_period" class="universal_label">От:</label>
                        <div type="text" id="hour_start_period_btn" class="input_dropdawn_fake_input" onclick="showStartPeriodHourDropdown();">Начален час</div>
                        <input type="text" name="hour_start_period" id="hour_start_period" class="hidden_input">
                        <div id="hour_start_period_dropdown" class="input_dropdawn">';
                            $resultSelectHours = $conn -> query($sqlSelectHours);
                            while($rowSelectHours = $resultSelectHours->fetch_assoc()){
                                $number_hour = $rowSelectHours["number_hour"];
                                $start_hour = $rowSelectHours["start_hour"];
                                $end_hour = $rowSelectHours["end_hour"];
                                echo '
                                    <div class="input_dropdawn_btn" onclick="assignValueStartPeriodHour(this.innerHTML)">Час ' . $number_hour . ' от ' . $start_hour . ' до ' . $end_hour . '</div>
                                ';	
                            }
                        echo '
                        </div>
                        <script>
                            var hour_start_period = document.getElementById(\'hour_start_period\');
                            var hour_start_period_dropdown = document.getElementById(\'hour_start_period_dropdown\');
                            var hour_start_period_btn = document.getElementById(\'hour_start_period_btn\');
                            function showStartPeriodHourDropdown(){
                                CloseAllDropdowns();
                                hour_start_period_dropdown.style.display = "block";
                            }
                            function hideStartPeriodHourDropdown(){
                                hour_start_period_dropdown.style.display = "none";
                            }
                            function assignValueStartPeriodHour(value){
                                hour_specific_btn.innerHTML = "Час";
                                hour_specific.value = "";

                                hour_start_period_dropdown.style.display = "none";
                                hour_start_period_btn.style.color = "black";
                                hour_start_period_btn.innerHTML = value;
                                hour_start_period.value = value;
                            }
                        </script>
                        <label for="hour_start_period" class="universal_label">До:</label>
                        <div type="text" id="hour_end_period_btn" class="input_dropdawn_fake_input" onclick="showEndPeriodHourDropdown();">Краен час</div>
                        <input type="text" name="hour_end_period" id="hour_end_period" class="hidden_input">
                        <div id="hour_end_period_dropdown" class="input_dropdawn">';
                            $resultSelectHours = $conn -> query($sqlSelectHours);
                            while($rowSelectHours = $resultSelectHours->fetch_assoc()){
                                $number_hour = $rowSelectHours["number_hour"];
                                $start_hour = $rowSelectHours["start_hour"];
                                $end_hour = $rowSelectHours["end_hour"];
                                echo '
                                    <div class="input_dropdawn_btn" onclick="assignValueEndPeriodHour(this.innerHTML)">Час ' . $number_hour . ' от ' . $start_hour . ' до ' . $end_hour . '</div>
                                ';	
                            }
                        echo '
                        </div>
                        <script>
                            var hour_end_period = document.getElementById(\'hour_end_period\');
                            var hour_end_period_dropdown = document.getElementById(\'hour_end_period_dropdown\');
                            var hour_end_period_btn = document.getElementById(\'hour_end_period_btn\');
                            function showEndPeriodHourDropdown(){
                                CloseAllDropdowns();
                                hour_end_period_dropdown.style.display = "block";
                            }
                            function hideEndPeriodHourDropdown(){
                                hour_end_period_dropdown.style.display = "none";
                            }
                            function assignValueEndPeriodHour(value){
                                hour_specific_btn.innerHTML = "Час";
                                hour_specific.value = "";

                                hour_end_period_dropdown.style.display = "none";
                                hour_end_period_btn.style.color = "black";
                                hour_end_period_btn.innerHTML = value;
                                hour_end_period.value = value;
                            }
                        </script>
                    </div>
                    <script>
                        function showHourSpecificInput(){
                            CloseAllDropdowns();
                            document.getElementById("hour_period_input").style.display="none";
                            document.getElementById("hour_specific_input").style.display="block";
                        }
                        function showHourPeriodInput(){
                            CloseAllDropdowns();
                            document.getElementById("hour_specific_input").style.display="none";
                            document.getElementById("hour_period_input").style.display="block";
                        }
                    </script>
                    <p id="err_p4" class="err_p"></p>
                    <input type="submit" name="submit" class="universal_submit_btn" value="Добави резервация">
                </form>
            ';
            $owner_id = $_COOKIE["admin_panel_user_id"];
            $event_name = $_POST["event_name"];
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            $date = $_POST["date"];
            $start_hour = $_POST["hour_start_period"];
            $end_hour = $_POST["hour_end_period"];
            $hour = $_POST["hour"];
            if(isset($_POST["submit"]) && $event_name != "" &&  $start_date != "" &&  $end_date != "" && $start_hour != "" && $end_hour != "" ||
               isset($_POST["submit"]) && $event_name != "" &&  $date != "" && $start_hour != "" && $end_hour != "" ||
               isset($_POST["submit"]) && $event_name != "" &&  $start_date != "" &&  $end_date != "" && $hour != "" ||
               isset($_POST["submit"]) && $event_name != "" &&  $date != "" && $hour != "" ){
                if($date != ""){
                    $start_date = $date;
                    $end_date = $date;
                }
                if($hour != ""){
                    $start_hour = $hour;
                    $end_hour = $hour;
                }
                $change_location = true;
                $start = new DateTime($start_date);
                $end = new DateTime($end_date);
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

                        $start_schedule_id = intval(str_replace(" ", "", substr($start_hour, 6, 3))) + $shedule_base;
                        $end_schedule_id = intval(str_replace(" ", "", substr($end_hour, 6, 3)))  + $shedule_base;
                        $date=$dt->format('Y-m-d');
                        for($schedule_id = $start_schedule_id; $schedule_id <= $end_schedule_id; $schedule_id++){
                            $sqlInsert = "INSERT INTO `teachers_room_schedule` (`id`, `event_name`, `date`, `schedule_id`, `owner_id`, `added_date`)
                            SELECT NULL, '$event_name', '$date', '$schedule_id', '$owner_id', CURRENT_TIMESTAMP()
                            FROM DUAL  
                            WHERE NOT EXISTS (
                                SELECT * FROM `teachers_room_schedule` 
                                WHERE `date` = '$date' AND `schedule_id` = '$schedule_id' 
                            ) 
                            LIMIT 1";
                            if($conn->query($sqlInsert) === TRUE) {
                                $change_location = true;
                            }
                            else{
                                $change_location = false;
                            }
                        }
                    }
                }
                if($change_location) {
                    echo "
                        <script>
                            window.location.assign('../teachers_room_schedule/');
                        </script>
                    ";
                }
            }/*
            if(isset($_POST["submit"])){
                if($start_date == ""){
                    echo '
                    <script>
                        document.getElementById("err_p1").innerHTML = "*Изберете тип резервация";
                        document.getElementById("err_p1").style.display = "block";
                    </script>
                    ';
                }
                if($end_date == ""){
                    echo '
                    <script>
                        document.getElementById("err_p2").innerHTML = "*Въведете крайна дата";
                        document.getElementById("err_p2").style.display = "block";
                    </script>
                    ';
                }
                if($end_date == ""){
                    echo '
                    <script>
                        document.getElementById("err_p3").innerHTML = "*Въведете крайна дата";
                        document.getElementById("err_p3").style.display = "block";
                    </script>
                    ';
                }
            }*/
        ?>
    </div>
    <?php include "../user_colors.php";?>
</body>
</html>