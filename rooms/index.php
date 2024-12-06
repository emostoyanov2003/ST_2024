<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel | График на учителската стая</title>
    <link rel="stylesheet" href="../Style_admin.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" href="../admin_images/logo.png">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>        
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&family=Jost:wght@200;300&family=M+PLUS+1p:wght@100&family=Sawarabi+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
        include "../connection.php";
        include "../admin_menu.php";
        //error_reporting(0);
    ?>
    <script>
        document.getElementById("rooms").style.borderLeft = "2px solid";
    </script>
    <div class="admin_page_container">
        <?php
            error_reporting(~E_WARNING & ~E_DEPRECATED);
            $search_block = $_GET["block"];
            if ($search_block != ""){
                echo '
                    <p class="admin_page_label">' . $search_block . ' стаи</p>
                ';
            }
            else{
                echo '
                    <p class="admin_page_label">Стаи</p>
                ';
            }
        ?>
        <form method="post" enctype="multipart/form-data" style="margin-top: -10px;">
        <?php
            if($user_type == "admin"){
                echo '
                    <button id="mark_all_btn" type="button" class="admin_page_control_btn" onclick="markAllRows()"><i class="fa fa-check-square"></i> Маркиране на всички</button>
                    <button id="delete_marked_btn" name="delete_marked_btn" class="admin_page_control_btn"><i class="fa fa-trash"></i> Изтриване</button>
                    <script>
                        checkboxes = document.getElementsByClassName("checkbox_input");
                        function markAllRows(){
                            for(i = 0; i < checkboxes.length; i++){
                                checkboxes[i].checked = true;
                            }
                            document.getElementById("mark_all_btn").setAttribute("onclick", "unmarkAllRows()");
                        }
                        function unmarkAllRows(){
                            for(i = 0; i < checkboxes.length; i++){
                                checkboxes[i].checked = false;
                            }
                            document.getElementById("mark_all_btn").setAttribute("onclick", "markAllRows()");
                        }
                    </script>
                    <button type="button" class="admin_page_control_btn" style="margin-bottom: 10px;" onclick="window.location.assign(\'../rooms_add\');"><i class="fa fa-plus-circle"></i> Добави</button>
                ';
            }
        ?>
        <?php
            $search_block = $bodytag = str_replace("Блок ", "", $search_block);
            $search_type = $_GET["search_type"];
            if($search_type != "free rooms"){
                if($search_block != ""){
                    $sql = "SELECT * FROM `rooms` WHERE `block` = '$search_block' ORDER BY `block`";
                    
                    $result = $conn -> query($sql);
                    $number = 1;
                    $last_block = 0;
                    
                    if($user_type == "admin"){
                        while($row = $result->fetch_assoc()){
                            $id = $row["id"];
                            $room_number = $row["room_number"];
                            $room_name = $row["room_name"];
                            $block = $row["block"];
                            if($last_block != $block && $search_block == "" || $last_block == "" && $search_block == ""){
                                echo '
                                    <p class="admin_page_inner_label">БЛОК ' . $block . '</p>
                                ';
                            }
                            echo '
                                <div class="admin_page_row">
                                    <label class="container">
                                        <input type="checkbox" class="checkbox_input" name="checkbox_' . $id  . '">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p class="admin_page_row_two_btns_p">' . $number . '. ' . $room_number . ' ' . $room_name . '</p>
                                <button type="button" class="admin_page_row_btn" onclick="window.location.assign(\'../rooms_edit/?id=' . md5($id) . '\')"><i class="fa fa-pencil"></i> Редактирай</button>
                                    <button type="button" class="admin_page_row_btn" onclick="window.location.assign(\'../room_schedule/?room_id=' . md5($id) . '\')"><i class="fa fa-file"></i> Отвори</button>
                                </div>
                            ';
                            $last_block = $block; $number++;
                        }  
                    }
                    else {
                        while($row = $result->fetch_assoc()){
                            $id = $row["id"];
                            $room_number = $row["room_number"];
                            $room_name = $row["room_name"];
                            $block = $row["block"];
                            if($last_block != $block && $search_block == "" || $last_block == "" && $search_block == ""){
                                echo '
                                    <p class="admin_page_inner_label">БЛОК ' . $block . '</p>
                                ';
                            }
                            echo '
                                <div class="admin_page_row">
                                    <label class="container">
                                        <input type="checkbox" class="checkbox_input" name="checkbox_' . $id  . '">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p class="admin_page_row_p">' . $number . '. ' . $room_number . ' ' . $room_name . '</p>
                                    <button type="button" class="admin_page_row_btn" onclick="window.location.assign(\'../room_schedule/?id=' . md5($id) . '\')"><i class="fa fa-file"></i> Отвори</button>
                                </div>
                            ';
                            $last_block = $block; $number++;
                        }  
                    }
                    if(isset($_POST["delete_marked_btn"])){
                        $sqlSelect = "SELECT * FROM `rooms`";
                        $result = $conn -> query($sqlSelect);
                        while($row = $result->fetch_assoc()){
                            $id = $row["id"];
                            if(isset($_POST["checkbox_" . $id  . ""])){
                                $sqlDelete = "DELETE FROM `rooms` WHERE `id` = '$id'";
                                $conn -> query($sqlDelete);
                            }
                        }
                        echo "
                            <script>
                                window.location.assign('');
                            </script>
                        ";
                    }
                    echo '
                        <script>
                            document.getElementById("accepted_label").innerHTML = "Одобрени - ' . $number - 1 . '";
                        </script>
                    ';
                    }
                else {
                    $sql = "SELECT * FROM `rooms` ORDER BY `block`";
                    $result = $conn -> query($sql);
                    $number = 1;
                    $last_block = 0;
                    
                    if($user_type == "admin"){
                        while($row = $result->fetch_assoc()){
                            $id = $row["id"];
                            $room_number = $row["room_number"];
                            $room_name = $row["room_name"];
                            $block = $row["block"];
                            if($last_block != $block && $search_block == "" || $last_block == "" && $search_block == ""){
                                echo '
                                    <p class="admin_page_inner_label">БЛОК ' . $block . '</p>
                                ';
                            }
                            echo '
                                <div class="admin_page_row">
                                    <label class="container">
                                        <input type="checkbox" class="checkbox_input" name="checkbox_' . $id  . '">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p class="admin_page_row_two_btns_p">' . $number . '. ' . $room_number . ' ' . $room_name . '</p>
                                <button type="button" class="admin_page_row_btn" onclick="window.location.assign(\'../rooms_edit/?id=' . md5($id) . '\')"><i class="fa fa-pencil"></i> Редактирай</button>
                                    <button type="button" class="admin_page_row_btn" onclick="window.location.assign(\'../room_schedule/?room_id=' . md5($id) . '\')"><i class="fa fa-file"></i> Отвори</button>
                                </div>
                            ';
                            $last_block = $block; $number++;
                        }  
                    }
                    else {
                        while($row = $result->fetch_assoc()){
                            $id = $row["id"];
                            $room_number = $row["room_number"];
                            $room_name = $row["room_name"];
                            $block = $row["block"];
                            if($last_block != $block && $search_block == "" || $last_block == "" && $search_block == ""){
                                echo '
                                    <p class="admin_page_inner_label">БЛОК ' . $block . '</p>
                                ';
                            }
                            echo '
                                <div class="admin_page_row">
                                    <label class="container">
                                        <input type="checkbox" class="checkbox_input" name="checkbox_' . $id  . '">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p class="admin_page_row_p">' . $number . '. ' . $room_number . ' ' . $room_name . '</p>
                                    <button type="button" class="admin_page_row_btn" onclick="window.location.assign(\'../room_schedule/?id=' . md5($id) . '\')"><i class="fa fa-file"></i> Отвори</button>
                                </div>
                            ';
                            $last_block = $block; $number++;
                        }  
                    }
                    if(isset($_POST["delete_marked_btn"])){
                        $sqlSelect = "SELECT * FROM `rooms`";
                        $result = $conn -> query($sqlSelect);
                        while($row = $result->fetch_assoc()){
                            $id = $row["id"];
                            if(isset($_POST["checkbox_" . $id  . ""])){
                                $sqlDelete = "DELETE FROM `rooms` WHERE `id` = '$id'";
                                $conn -> query($sqlDelete);
                            }
                        }
                        echo "
                            <script>
                                window.location.assign('');
                            </script>
                        ";
                    }
                    echo '
                        <script>
                            document.getElementById("accepted_label").innerHTML = "Одобрени - ' . $number - 1 . '";
                        </script>
                    ';
                }
            }
            if($search_type == "free rooms"){
                $start_date = $_GET["start_date"];
                $end_date = $_GET["end_date"];
                $start_hour = $_GET["start_hour"];
                $end_hour = $_GET["end_hour"];
                $day = $_GET["day"];
                
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
                        $taken_rooms = array();
                        for($schedule_id = $start_schedule_id; $schedule_id <= $end_schedule_id; $schedule_id++){
                            if($curr == $day && $day != "All"){
                                $sqlSelectTaken = "SELECT * FROM `room_schedule` WHERE `date` = '$date' AND `schedule_id` = '$schedule_id'";
                                $resultTaken = $conn -> query($sqlSelectTaken);
                                while($rowTaken = $resultTaken->fetch_assoc()){
                                    if(!in_array($rowTaken["room_id"], $taken_rooms))
                                        array_push($taken_rooms, $rowTaken["room_id"]);
                                }
                            }
                            else if($day == "All"){
                                $sqlSelectTaken = "SELECT * FROM `room_schedule` WHERE `date` = '$date' AND `schedule_id` = '$schedule_id'";
                                $resultTaken = $conn -> query($sqlSelectTaken);
                                while($rowTaken = $resultTaken->fetch_assoc()){
                                    if(!in_array($rowTaken["room_id"], $taken_rooms))
                                        array_push($taken_rooms, $rowTaken["room_id"]);
                                }
                            }
                        }
                    }
                }
                
                        
                $number = 1;
                $last_block = 0;
                $sqlSelectAllRooms = "SELECT * FROM `rooms` ORDER BY `block`";
                $result = $conn -> query($sqlSelectAllRooms);
                while($row = $result->fetch_assoc()){
                    $id = $row["id"];
                    if(!in_array(md5($id), $taken_rooms)){
                        if($user_type == "admin"){
                            $room_number = $row["room_number"];
                            $room_name = $row["room_name"];
                            $block = $row["block"];
                            if($last_block != $block && $search_block == "" || $last_block == "" && $search_block == ""){
                                echo '
                                    <p class="admin_page_inner_label">БЛОК ' . $block . '</p>
                                ';
                            }
                            echo '
                                <div class="admin_page_row">
                                    <label class="container">
                                        <input type="checkbox" class="checkbox_input" name="checkbox_' . $id  . '">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p class="admin_page_row_two_btns_p">' . $number . '. ' . $room_number . ' ' . $room_name . '</p>
                                <button type="button" class="admin_page_row_btn" onclick="window.location.assign(\'../rooms_edit/?id=' . md5($id) . '\')"><i class="fa fa-pencil"></i> Редактирай</button>
                                    <button type="button" class="admin_page_row_btn" onclick="window.location.assign(\'../room_schedule/?room_id=' . md5($id) . '\')"><i class="fa fa-file"></i> Отвори</button>
                                </div>
                            ';
                            $last_block = $block; $number++;
                        }
                        else {
                            $room_number = $row["room_number"];
                            $room_name = $row["room_name"];
                            $block = $row["block"];
                            if($last_block != $block && $search_block == "" || $last_block == "" && $search_block == ""){
                                echo '
                                    <p class="admin_page_inner_label">БЛОК ' . $block . '</p>
                                ';
                            }
                            echo '
                                <div class="admin_page_row">
                                    <label class="container">
                                        <input type="checkbox" class="checkbox_input" name="checkbox_' . $id  . '">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p class="admin_page_row_p">' . $number . '. ' . $room_number . ' ' . $room_name . '</p>
                                    <button type="button" class="admin_page_row_btn" onclick="window.location.assign(\'../room_schedule/?id=' . md5($id) . '\')"><i class="fa fa-file"></i> Отвори</button>
                                </div>
                            ';
                            $last_block = $block; $number++;
                        }
                        if(isset($_POST["delete_marked_btn"])){
                            $sqlSelect = "SELECT * FROM `rooms`";
                            $result = $conn -> query($sqlSelect);
                            while($row = $result->fetch_assoc()){
                                $id = $row["id"];
                                if(isset($_POST["checkbox_" . $id  . ""])){
                                    $sqlDelete = "DELETE FROM `rooms` WHERE `id` = '$id'";
                                    $conn -> query($sqlDelete);
                                }
                            }
                            echo "
                                <script>
                                    window.location.assign('');
                                </script>
                            ";
                        }
                        echo '
                            <script>
                                document.getElementById("accepted_label").innerHTML = "Одобрени - ' . $number - 1 . '";
                            </script>
                        ';
                    }
                }
            }
        ?>
        </form>
        <script>
            FillCells(cells<?php echo date("W");?>);
        </script>
    </div>
    <?php include "../user_colors.php";?>
</body>
</html>