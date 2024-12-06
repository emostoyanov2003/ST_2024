<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel | Добавяне на стая</title>
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
        <p class="admin_page_label">Добавяне на стая</p>
        <?php
            error_reporting(1);
            echo '
                <form method="post" enctype="multipart/form-data">
                <input type="text" name="room_number" id="room_number" class="universal_input" placeholder="Номер на зала" autocomplete="off">
                <p id="err_p1" class="err_p"></p>
                <input type="text" name="room_name" id="room_name" class="universal_input" placeholder="Име на зала" autocomplete="off" min="8">
                <p id="err_p2" class="err_p"></p>
                    <div type="text" id="day_btn" class="input_dropdawn_fake_input" onmouseover="showDayDropdown();" onmouseout="hideDayDropdown();">Блок</div>
                    <input type="text" name="block" id="day" class="hidden_input">
                    <div id="day_dropdown" class="input_dropdawn" onmouseover="showDayDropdown();" onmouseout="hideDayDropdown();">
                        <div class="input_dropdawn_btn" onclick="assignValueDay(\'1\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Блок 1</div>
                        <div class="input_dropdawn_btn" onclick="assignValueDay(\'2\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Блок 2</div>
                        <div class="input_dropdawn_btn" onclick="assignValueDay(\'3\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Блок 3</div>
                        <div class="input_dropdawn_btn" onclick="assignValueDay(\'4\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Блок 4</div>
                        <div class="input_dropdawn_btn" onclick="assignValueDay(\'5\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Блок 5</div>
                        <div class="input_dropdawn_btn" onclick="assignValueDay(\'6\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Блок 6</div>
                        <div class="input_dropdawn_btn" onclick="assignValueDay(\'7\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Блок 7</div>
                        <div class="input_dropdawn_btn" onclick="assignValueDay(\'8\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Блок 8</div>
                        <div class="input_dropdawn_btn" onclick="assignValueDay(\'9\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Блок 9</div>
                        <div class="input_dropdawn_btn" onclick="assignValueDay(\'10\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Блок 10</div>
                        <div class="input_dropdawn_btn" onclick="assignValueDay(\'11\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Блок 11</div>
                        <div class="input_dropdawn_btn" onclick="assignValueDay(\'12\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Блок 12</div>
                    </div>
                    <script>
                        var day = document.getElementById(\'day\');
                        var day_dropdown = document.getElementById(\'day_dropdown\');
                        var day_btn = document.getElementById(\'day_btn\');
                        function showDayDropdown(){
                            day_dropdown.style.display = "block";
                        }
                        function hideDayDropdown(){
                            day_dropdown.style.display = "none";
                        }
                        function assignValueDay(value){
                            day_dropdown.style.display = "none";
                            day_btn.style.color = "black";
                            day.value = value;
                        }
                    </script>
                    <p id="err_p3" class="err_p"></p>
                    <p id="err_p4" class="err_p"></p>
                    <input type="submit" name="submit" class="universal_submit_btn" value="Добави стая">
                </form>
            ';
            $room_number = preg_replace('/[^A-Za-zА-Яа-я0-9\-]/u', '', $_POST["room_number"]); // Removes special chars.
            $room_name = preg_replace('/[^A-Za-zА-Яа-я0-9. \-]/u', '', $_POST["room_name"]); // Removes special chars.
            $block = $_POST["block"];
            if(isset($_POST["submit"]) && $room_name != "" && $room_number != "" && $block != ""){
                $sqlInsert = "INSERT INTO `rooms` (`id`, `room_number`, `room_name`, `block`, `added_date`)
                SELECT NULL, '$room_number', '$room_name', '$block', CURRENT_TIMESTAMP()
                FROM DUAL  
                WHERE NOT EXISTS (
                    SELECT * FROM `rooms` 
                    WHERE `room_number` = '$room_number' AND `room_name` = '$room_name'  AND `block` = '$block' 
                ) 
                LIMIT 1";
                if($conn->query($sqlInsert) === TRUE) {
                    if ($conn->affected_rows > 0) {
                        // A row was inserted
                        echo "
                            <script>
                                window.location.assign('../rooms/');
                            </script>
                        ";
                    } else {
                        // No row was inserted (likely because it already exists)
                        echo '
                        <script>
                            document.getElementById("err_p4").innerHTML = "*Вече е създадена такава стая";
                            document.getElementById("err_p4").style.display = "block";
                        </script>
                        ';
                    }
                }
            }
            if(isset($_POST["submit"])){
                if($room_number == ""){
                    echo '
                    <script>
                        document.getElementById("err_p1").innerHTML = "*Въведете номер на стая";
                        document.getElementById("err_p1").style.display = "block";
                    </script>
                    ';
                }
                if($room_name == "" || strlen($room_name) < 8){
                    echo '
                    <script>
                        document.getElementById("err_p2").innerHTML = "*Въведете име на стая с поне 8 символа";
                        document.getElementById("err_p2").style.display = "block";
                    </script>
                    ';
                }
                if($block == ""){
                    echo '
                    <script>
                        document.getElementById("err_p3").innerHTML = "*Изберете блок";
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