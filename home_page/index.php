﻿<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel | Начало</title>
    <link rel="stylesheet" href="../../Style.css">
    <link rel="stylesheet" href="../Style_admin.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" href="../admin_images/logo.png">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>     
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&family=Jost:wght@200;300&family=M+PLUS+1p:wght@100&family=Sawarabi+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <script>
        document.getElementById("home_page").style.borderLeft = "2px solid #5F8CC3";
    </script>
    <div class="admin_page_container">
        <p class="admin_page_label">Търсене на свободна стая</p>
        <?php
            error_reporting(1);
            echo '
                <form method="post" enctype="multipart/form-data">
                    <label for="date_time" class="universal_label">Резервиране на стая за:</label>
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
                        <div type="text" id="day_btn" class="input_dropdawn_fake_input" onmouseover="showDayDropdown();" onmouseout="hideDayDropdown();">Ден от седмицата</div>
                        <input type="text" name="day" id="day" class="hidden_input">
                        <div id="day_dropdown" class="input_dropdawn" onmouseover="showDayDropdown();" onmouseout="hideDayDropdown();">
                            <div class="input_dropdawn_btn" onclick="assignValueDay(\'All\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Всички</div>
                            <div class="input_dropdawn_btn" onclick="assignValueDay(\'Mon\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Понеделник</div>
                            <div class="input_dropdawn_btn" onclick="assignValueDay(\'Tue\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Вторник</div>
                            <div class="input_dropdawn_btn" onclick="assignValueDay(\'Wed\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Сряда</div>
                            <div class="input_dropdawn_btn" onclick="assignValueDay(\'Thu\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Четвъртък</div>
                            <div class="input_dropdawn_btn" onclick="assignValueDay(\'Fri\'); document.getElementById(\'day_btn\').innerHTML = this.innerHTML;">Петък</div>
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
                    <p id="err_p2" class="err_p"></p>

                    <label for="hour_time" class="universal_label">По време на:</label>
                    <div class="radio-button-container">
                        <div class="radio-button">
                            <input type="radio" class="radio-button_input" id="hour_specific_radio" name="hour_time" onclick="showHourSpecificInput()">
                            <label class="radio-button_label" for="hour_specific_radio">
                                <span class="radio-button_custom"></span>
                                Конкретен час
                            </label>
                        </div>
                        <div class="radio-button">
                            <input type="radio" class="radio-button_input" id="hour_period_radio" name="hour_time" onclick="showHourPeriodInput()">
                            <label class="radio-button_label" for="hour_period_radio">
                                <span class="radio-button_custom"></span>
                                Период от часове
                            </label>
                        </div>
                    </div>
                    <div id="hour_specific_input" style="display: none;">
                        <div type="text" id="hour_specific_btn" class="input_dropdawn_fake_input" onmouseover="showHourDropdown();" onmouseout="hideHourDropdown();">Час</div>
                        <input type="text" name="hour_specific" id="hour_specific" class="hidden_input">
                        <div id="hour_specific_dropdown" class="input_dropdawn" onmouseover="showHourDropdown();" onmouseout="hideHourDropdown();">';
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
                        <div type="text" id="hour_start_period_btn" class="input_dropdawn_fake_input" onmouseover="showStartPeriodHourDropdown();" onmouseout="hideStartPeriodHourDropdown();">Начален час</div>
                        <input type="text" name="hour_start_period" id="hour_start_period" class="hidden_input">
                        <div id="hour_start_period_dropdown" class="input_dropdawn" onmouseover="showStartPeriodHourDropdown();" onmouseout="hideStartPeriodHourDropdown();">';
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
                        <div type="text" id="hour_end_period_btn" class="input_dropdawn_fake_input" onmouseover="showEndPeriodHourDropdown();" onmouseout="hideEndPeriodHourDropdown();">Краен час</div>
                        <input type="text" name="hour_end_period" id="hour_end_period" class="hidden_input">
                        <div id="hour_end_period_dropdown" class="input_dropdawn" onmouseover="showEndPeriodHourDropdown();" onmouseout="hideEndPeriodHourDropdown();">';
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
                    <p id="err_p3" class="err_p"></p>
                    <p id="err_p4" class="err_p"></p>
                    <input type="submit" name="submit" class="universal_submit_btn" value="Намери свободна стая">
                </form>
            ';
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            $date = $_POST["date"];
            $start_hour = $_POST["hour_start_period"];
            $end_hour = $_POST["hour_end_period"];
            $hour_specific = $_POST["hour_specific"];
            $day = $_POST["day"];
            if($day == ""){
                $day = "All";
            }
            $current_date = date("Y-m-d");
            $dateCheck = false;
            if($date > $current_date || $start_date > $current_date && $end_date >= $start_date){
                $dateCheck = true;
            }
            if(isset($_POST["submit"]) && $dateCheck == true &&  $start_date != "" &&  $end_date != "" && $start_hour != "" && $end_hour != "" && $day != "" ||
               isset($_POST["submit"]) && $dateCheck == true &&  $date != "" && $start_hour != "" && $end_hour != "" ||
               isset($_POST["submit"]) && $dateCheck == true &&  $start_date != "" &&  $end_date != "" && $hour_specific != "" && $day != "" ||
               isset($_POST["submit"]) && $dateCheck == true &&  $date != "" && $hour_specific != ""){
                if($date != ""){
                    $start_date = $date;
                    $end_date = $date;
                }
                if($hour_specific != ""){
                    $start_hour = $hour_specific;
                    $end_hour = $hour_specific;
                }
                echo "
                    <script>
                        window.location.assign('../rooms/?search_type=free rooms&start_date=" . $start_date . "&end_date=" . $end_date . "&start_hour=" . $start_hour . "&end_hour=" . $end_hour . "&day=" . $day . "');
                    </script>
                ";
            }
            if(isset($_POST["submit"])){
                if(!($date == "" && $day != "" && $start_date != "" && $end_date != "" || $date != "" && $day == "" && $start_date == "" && $end_date == "") || $dateCheck == false){
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
        <br>
        <p class="admin_page_label">Блокове</p>
        <br>
        <div class="block_container">
            <a href="../rooms/?block=Блок 1" class="block_container_element">Блок 1</a>
            <a href="../rooms/?block=Блок 2" class="block_container_element">Блок 2</a>
            <a href="../rooms/?block=Блок 3" class="block_container_element">Блок 3</a>
            <a href="../rooms/?block=Блок 4" class="block_container_element">Блок 4</a>
            <a href="../rooms/?block=Блок 5" class="block_container_element">Блок 5</a>
            <a href="../rooms/?block=Блок 6" class="block_container_element">Блок 6</a>
            <a href="../rooms/?block=Блок 7" class="block_container_element">Блок 7</a>
            <a href="../rooms/?block=Блок 8" class="block_container_element">Блок 8</a>
            <a href="../rooms/?block=Блок 9" class="block_container_element">Блок 9</a>
            <a href="../rooms/?block=Блок 10" class="block_container_element">Блок 10</a>
            <a href="../rooms/?block=Блок 11" class="block_container_element">Блок 11</a>
            <a href="../rooms/?block=Блок 12" class="block_container_element">Блок 12</a>
        </div>
    </div>
    <?php include "../user_colors.php";?>
</body>
</html>