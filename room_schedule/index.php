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
        document.getElementById("room_schedule").style.borderLeft = "2px solid";
    </script>
    <div class="admin_page_container">
        <?php
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
            echo '<p class="admin_page_label">График на стая ' . $room_number . ' ' . $room_name . ' в блок ' . $block . '</p>';
        ?>
        <div class="table_container">
            <div class="schedule_week_btn_container">
                <?php
                    $counter = 1;
                    for ($i=0; $i < 12 * 7; $i+=7) { 
                        echo '<button id="week_' . $counter . '" class="schedule_week_btn" onclick="ChangeWeek(this); FillCells(cells' . date('W', time()+($i - 21- date('w'))*24*3600) . ')">' . date('d.m.Y г.',time()+($i - 27 - date('w'))*24*3600) . ' - ' . date('d.m.Y г.',time()+($i + 6 - 27 - date('w'))*24*3600) . '</button>';
                        $counter++;
                    }
                ?>
                <script>
                    document.getElementById("week_5").style.backgroundColor = "#2A529A";
                    document.getElementById("week_5").style.color = "white";
                    function ChangeWeek(elm){
                        weekButtons = document.getElementsByClassName("schedule_week_btn");
                        for(i = 0; i < weekButtons.length; i++){
                            weekButtons[i].style.backgroundColor = "white";
                            weekButtons[i].style.color = "#333";
                        }
                        elm.style.backgroundColor = "#2A529A";
                        elm.style.color = "white";
                    }
                </script>
            </div>
            <br>
            <table class="teachers_room_schedule_table">
                <tr>
                    <th>ДЕН / ЧАС</th>
                    <th>1-ви час<br><i>от 7:45 до 8:25</i></th>
                    <th>2-ри час<br><i>от 8:30 до 9:10</i></th>
                    <th>3-ти час<br><i>от 9:20 до 10:00</i></th>
                    <th>4-ти час<br><i>от 10:20 до 11:00</i></th>
                    <th>5-ти час<br><i>от 11:10 до 11:50</i></th>
                    <th>6-ти час<br><i>от 12:00 до 12:40</i></th>
                    <th>7-ти час<br><i>от 12:45 до 13:25</i></th>
                    <th>8-ти час<br><i>от 13:35 до 14:15</i></th>
                    <th>9-ти час<br><i>от 14:25 до 15:05</i></th>
                    <th>10-ти час<br><i>от 15:10 до 15:50</i></th>
                    <th>11-ти час<br><i>от 16:10 до 16:50</i></th>
                    <th>12-ти час<br><i>от 17:00 до 17:40</i></th>
                    <th>13-ти час<br><i>от 17:50 до 18:30</i></th>
                    <th>14-ти час<br><i>от 18:35 до 19:15</i></th>
                </tr>
                <tr>
                    <th>ПОНЕДЕЛНИК</th>
                    <td id="1">-</td>
                    <td id="2">-</td>
                    <td id="3">-</td>
                    <td id="4">-</td>
                    <td id="5">-</td>
                    <td id="6">-</td>
                    <td id="7">-</td>
                    <td id="8">-</td>
                    <td id="9">-</td>
                    <td id="10">-</td>
                    <td id="11">-</td>
                    <td id="12">-</td>
                    <td id="13">-</td>
                    <td id="14">-</td>
                </tr>
                <tr>
                    <th>ВТОРНИК</th>
                    <td id="15">-</td>
                    <td id="16">-</td>
                    <td id="17">-</td>
                    <td id="18">-</td>
                    <td id="19">-</td>
                    <td id="20">-</td>
                    <td id="21">-</td>
                    <td id="22">-</td>
                    <td id="23">-</td>
                    <td id="24">-</td>
                    <td id="25">-</td>
                    <td id="26">-</td>
                    <td id="27">-</td>
                    <td id="28">-</td>
                </tr>
                <tr>
                    <th>СРЯДА</t-h>
                    <td id="29">-</td>
                    <td id="30">-</td>
                    <td id="31">-</td>
                    <td id="32">-</td>
                    <td id="33">-</td>
                    <td id="34">-</td>
                    <td id="35">-</td>
                    <td id="36">-</td>
                    <td id="37">-</td>
                    <td id="38">-</td>
                    <td id="39">-</td>
                    <td id="40">-</td>
                    <td id="41">-</td>
                    <td id="42">-</td>
                </tr>
                <tr>
                    <th>ЧЕТВЪРЪК</th>
                    <td id="43">-</td>
                    <td id="44">-</td>
                    <td id="45">-</td>
                    <td id="46">-</td>
                    <td id="47">-</td>
                    <td id="48">-</td>
                    <td id="49">-</td>
                    <td id="50">-</td>
                    <td id="51">-</td>
                    <td id="52">-</td>
                    <td id="53">-</td>
                    <td id="54">-</td>
                    <td id="55">-</td>
                    <td id="56">-</td>
                </tr>
                <tr>
                    <th>ПЕТЪК</th>
                    <td id="57">-</td>
                    <td id="58">-</td>
                    <td id="59">-</td>
                    <td id="60">-</td>
                    <td id="61">-</td>
                    <td id="62">-</td>
                    <td id="63">-</td>
                    <td id="64">-</td>
                    <td id="65">-</td>
                    <td id="66">-</td>
                    <td id="67">-</td>
                    <td id="68">-</td>
                    <td id="69">-</td>
                    <td id="70">-</td>
                </tr>
            </table>
        </div>
        <br>
        <p class="admin_page_label">Мой резервации</p>
        <form method="post" enctype="multipart/form-data" style="margin-top: -10px;">
        <button id="mark_all_btn" type="button" class="admin_page_control_btn" onclick="markAllRows()"><i class="fa fa-check-square"></i> Маркиране на всички</button>
        <button id="delete_marked_btn" name="delete_marked_btn" class="admin_page_control_btn"><i class="fa fa-trash"></i> Изтриване</button>
        <?php
            if($user_type == "admin" || $user_type == "teachers_room_admin"){
                echo '
                    <button id="accept_marked_btn" name="accept_marked_btn" class="admin_page_control_btn"><i class="fa fa-check-circle-o"></i> Одобри</button>
                ';
            }
        ?>
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
        <button type="button" class="admin_page_control_btn" style="margin-bottom: 10px;" onclick="<?php echo "window.location.assign('../room_schedule_add/?room_id=" . $room_id . "');"?>"><i class="fa fa-plus-circle"></i> Добави</button>
        <script>
            <?php
                for ($i=0; $i < 12 * 7; $i+=7) { 
                    echo 'cells' . date('W', time()+($i - 21- date('w'))*24*3600) . ' = [];';
                }
            ?>
            function FillCells(cells){
                tds = document.getElementsByTagName("td");
                for (td of tds){
                    td.innerHTML = "-";
                    td.style.color = "#333";
                    td.style.backgroundColor = "#f5f5f5";
                }
                for(i = 0; i < cells.length; i++){
                    document.getElementById(cells[i].shedule_id).style.backgroundColor = "orangered";
                    document.getElementById(cells[i].shedule_id).style.color = "white";
                    document.getElementById(cells[i].shedule_id).innerHTML = cells[i].event_name;
                }
            }
        </script>
        <?php
            $min_date = date('Y-m-d',time()+(-1 * 3 * 7 - 6 - date('w'))*24*3600);
            $max_date = date('Y-m-d',time()+(1 * 8 * 7  - date('w'))*24*3600);  
            //Coloring
            $sql = "SELECT * FROM `room_schedule` WHERE `date` <= '$max_date' AND `date` >= '$min_date' AND `accepted` = 1 AND `room_id` = '$room_id' ORDER BY `date` DESC";
            $result = $conn -> query($sql);
            while($row = $result->fetch_assoc()){
                $id = $row["id"];
                $event_name = $row["event_name"];
                $schedule_id = $row["schedule_id"];
                $sqlSelectHour = "SELECT `start_hour`, `end_hour`  FROM `schedule` WHERE `id` = '$schedule_id' ORDER BY `id` DESC";
                $resultSelectHour = $conn -> query($sqlSelectHour);
                $rowSelectHour = $resultSelectHour->fetch_assoc();
                $dateTimeObj = new DateTime($row["date"]);
                $week_id = $dateTimeObj->format("W");
                echo '
                    <script>
                        cells' . $week_id . '.push(
                            {
                                event_name: "' . $event_name . '",
                                shedule_id: "' . $schedule_id . '"
                            }
                        );
                    </script>
                ';
            }   
            //My reservations
            echo '
                <p class="admin_page_inner_label" id="accept_label" style="color: #2A529A;"></p>
            ';
            if($user_type == "admin" || $user_type == "teachers_room_admin"){
                $sql = "SELECT * FROM `room_schedule` WHERE `accepted` = 0 AND `room_id` = '$room_id' ORDER BY `date` DESC";
                $result = $conn -> query($sql);
                $number = 1;
                while($row = $result->fetch_assoc()){
                    $id = $row["id"];
                    $event_name = $row["event_name"];
                    $schedule_id = $row["schedule_id"];
                    $owner_id = $row["owner_id"];
                    $date = date("d.m.Y", strtotime($row["date"])) . ' г.';
                    $sqlSelectHour = "SELECT `start_hour`, `end_hour` FROM `schedule` WHERE `id` = '$schedule_id' ORDER BY `id` DESC";
                    $resultSelectHour = $conn -> query($sqlSelectHour);
                    $rowSelectHour = $resultSelectHour->fetch_assoc();
                    $start_hour = $rowSelectHour["start_hour"];
                    $end_hour = $rowSelectHour["end_hour"];
                    $dateTimeObj = new DateTime($row["date"]);
                    $week_id = $dateTimeObj->format("W");
                    $sqlSelectOwner = "SELECT `name`, `family` FROM `team` WHERE MD5(`id`) = '$owner_id'";
                    $resultSelectOwner = $connMain -> query($sqlSelectOwner);
                    $rowSelectOwner = $resultSelectOwner->fetch_assoc();
                    $name = $rowSelectOwner["name"];
                    $family = $rowSelectOwner["family"];
                    echo '
                        <div class="admin_page_row">
                            <label class="container">
                                <input type="checkbox" class="checkbox_input" name="checkbox_' . $id  . '">
                                <span class="checkmark"></span>
                            </label>
                            <p class="admin_page_row_p">' . $number . '. ' . $event_name . ' на ' . $date . ' от ' . $start_hour . ' ч. до ' . $end_hour . ' ч. - заявка на ' . $name . '  ' . $family . '</p>
                            <button type="submit" name="accept_' . $id  . '" class="admin_page_row_btn"><i class="fa fa-check-circle-o"></i> Одобри</button>
                        </div>
                    ';
                    $number++;
                    if(isset($_POST["accept_" . $id  . ""])){
                        $sqlAcceptUpdate = "UPDATE `room_schedule` SET `accepted`='1' WHERE `id` = '$id'";
                        $conn -> query($sqlAcceptUpdate);
                        echo "
                            <script>
                                window.location.assign('');
                            </script>
                        ";
                    }
                }
                if(isset($_POST["accept_marked_btn"])){
                    $sqlSelect = "SELECT * FROM `room_schedule`";
                    $result = $conn -> query($sqlSelect);
                    while($row = $result->fetch_assoc()){
                        $id = $row["id"];
                        if(isset($_POST["checkbox_" . $id  . ""])){
                            $sqlAcceptUpdate = "UPDATE `room_schedule` SET `accepted`='1' WHERE `id` = '$id'";
                            $conn -> query($sqlAcceptUpdate);
                        }
                    }
                    echo "
                        <script>
                            window.location.assign('');
                        </script>
                    ";
                }
                
                if(isset($_POST["delete_marked_btn"])){
                    $sqlSelect = "SELECT * FROM `room_schedule`";
                    $result = $conn -> query($sqlSelect);
                    while($row = $result->fetch_assoc()){
                        $id = $row["id"];
                        if(isset($_POST["checkbox_" . $id  . ""])){
                            $sqlDelete = "DELETE FROM `room_schedule` WHERE `id` = '$id'";
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
                        document.getElementById("accept_label").innerHTML = "Заявки за одобряване  - ' . $number - 1 . '";
                    </script>
                ';
            }
            echo '
                <p id="pending_acception_label" class="admin_page_inner_label" style="color: #AC0300;"></p>
            ';
            $owner_id = $_COOKIE["admin_panel_user_id"];
            if($user_type == "admin" || $user_type == "teachers_room_admin"){
                $sql = "SELECT * FROM `room_schedule` WHERE `accepted` = 0 AND `room_id` = '$room_id' ORDER BY `date` DESC";
            }
            else{
                $sql = "SELECT * FROM `room_schedule` WHERE `owner_id` = '$owner_id' AND `accepted` = 0  AND `room_id` = '$room_id'ORDER BY `date` DESC";
            }
            $result = $conn -> query($sql);
            $number = 1;
            while($row = $result->fetch_assoc()){
                $id = $row["id"];
                $event_name = $row["event_name"];
                $schedule_id = $row["schedule_id"];
                $date = date("d.m.Y", strtotime($row["date"])) . ' г.';
                $sqlSelectHour = "SELECT `start_hour`, `end_hour`  FROM `schedule` WHERE `id` = '$schedule_id' ORDER BY `id` DESC";
                $resultSelectHour = $conn -> query($sqlSelectHour);
                $rowSelectHour = $resultSelectHour->fetch_assoc();
                $start_hour = $rowSelectHour["start_hour"];
                $end_hour = $rowSelectHour["end_hour"];
                $dateTimeObj = new DateTime($row["date"]);
                $week_id = $dateTimeObj->format("W");
                $sqlSelectOwner = "SELECT `name`, `family` FROM `team` WHERE MD5(`id`) = '$owner_id'";
                $resultSelectOwner = $connMain -> query($sqlSelectOwner);
                $rowSelectOwner = $resultSelectOwner->fetch_assoc();
                $name = $rowSelectOwner["name"];
                $family = $rowSelectOwner["family"];
                echo '
                    <div class="admin_page_row">
                        <label class="container">
                            <input type="checkbox" class="checkbox_input" name="checkbox_' . $id  . '">
                            <span class="checkmark"></span>
                        </label>
                        <p class="admin_page_row_p">' . $number . '. ' . $event_name . ' на ' . $date . ' от ' . $start_hour . ' ч. до ' . $end_hour . ' ч. - заявка на ' . $name . '  ' . $family . '</p>
                        <button type="button" class="admin_page_row_btn" onclick="window.location.assign(\'../room_schedule_edit/?id=' . md5($id) . '&room_id='. $room_id .'\')"><i class="fa fa-pencil"></i> Редактирай</button>
                    </div>
                ';
                $number++;
            }
            if(isset($_POST["delete_marked_btn"])){
                $sqlSelect = "SELECT * FROM `room_schedule`";
                $result = $conn -> query($sqlSelect);
                while($row = $result->fetch_assoc()){
                    $id = $row["id"];
                    if(isset($_POST["checkbox_" . $id  . ""])){
                        $sqlDelete = "DELETE FROM `room_schedule` WHERE `id` = '$id'";
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
                    document.getElementById("pending_acception_label").innerHTML = "Изчакващи одобрение - ' . $number - 1 . '";
                </script>
            ';
            echo '
                <p id="accepted_label" class="admin_page_inner_label" p style="color: #008141;"></p>
            ';
            if($user_type == "admin" || $user_type == "teachers_room_admin"){
                $sql = "SELECT * FROM `room_schedule` WHERE `accepted` = 1 AND `room_id` = '$room_id' ORDER BY `date` DESC";
            }
            else{
                $sql = "SELECT * FROM `room_schedule` WHERE `owner_id` = '$owner_id' AND `accepted` = 1 AND `room_id` = '$room_id' ORDER BY `date` DESC";
            }
            $result = $conn -> query($sql);
            $number = 1;
            while($row = $result->fetch_assoc()){
                $id = $row["id"];
                $event_name = $row["event_name"];
                $schedule_id = $row["schedule_id"];
                $date = date("d.m.Y", strtotime($row["date"])) . ' г.';
                $sqlSelectHour = "SELECT `start_hour`, `end_hour`  FROM `schedule` WHERE `id` = '$schedule_id' ORDER BY `id` DESC";
                $resultSelectHour = $conn -> query($sqlSelectHour);
                $rowSelectHour = $resultSelectHour->fetch_assoc();
                $start_hour = $rowSelectHour["start_hour"];
                $end_hour = $rowSelectHour["end_hour"];
                $dateTimeObj = new DateTime($row["date"]);
                $week_id = $dateTimeObj->format("W");
                $sqlSelectOwner = "SELECT `name`, `family` FROM `team` WHERE MD5(`id`) = '$owner_id'";
                $resultSelectOwner = $connMain -> query($sqlSelectOwner);
                $rowSelectOwner = $resultSelectOwner->fetch_assoc();
                $name = $rowSelectOwner["name"];
                $family = $rowSelectOwner["family"];
                echo '
                    <div class="admin_page_row">
                        <label class="container">
                            <input type="checkbox" class="checkbox_input" name="checkbox_' . $id  . '">
                            <span class="checkmark"></span>
                        </label>
                        <p class="admin_page_row_p">' . $number . '. ' . $event_name . ' на ' . $date . ' от ' . $start_hour . ' ч. до ' . $end_hour . ' ч. - заявка на ' . $name . '  ' . $family . '</p>
                        <button type="button" class="admin_page_row_btn" onclick="window.location.assign(\'../room_schedule_edit/?id=' . md5($id) . '&room_id='. $room_id .'\')"><i class="fa fa-pencil"></i> Редактирай</button>
                    </div>
                ';
                $number++;
            }
            if(isset($_POST["delete_marked_btn"])){
                $sqlSelect = "SELECT * FROM `room_schedule`";
                $result = $conn -> query($sqlSelect);
                while($row = $result->fetch_assoc()){
                    $id = $row["id"];
                    if(isset($_POST["checkbox_" . $id  . ""])){
                        $sqlDelete = "DELETE FROM `room_schedule` WHERE `id` = '$id'";
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
        ?>
        </form>
        <script>
            FillCells(cells<?php echo date("W");?>);
        </script>
    </div>
    <?php include "../user_colors.php";?>
</body>
</html>