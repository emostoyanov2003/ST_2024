<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel | Редактиране на потребител</title>
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
</head>
<body>
    <?php
        include "../connection.php";
        include "../admin_menu.php";
        if($user_type != "admin" && $_COOKIE["admin_panel_user_id"] != $_GET["id"]){
            echo "
                <script>
                    window.location.assign('../error_page/');
                </script>
            ";
        }
    ?>
    <div class="admin_page_container">
        <p class="admin_page_label">Редактиране на потребител</p>
        <?php
            error_reporting(0);
            $id = $_GET["id"];
            $sqlSelect = "SELECT * FROM `team` WHERE MD5(`id`) = '$id'";
            $result = $connMain -> query($sqlSelect);
            $row = $result->fetch_assoc();
            $name = $row["name"];
            $family = $row["family"];
            $image = $row["image"];
            $filename1 = $image;
            if($image == ""){
                $image = "../admin_images/account_image.png";
            }
            else{
                $image = 'https://tcom-sf.org/team/team_images/' . $image;
            }
            $job = $row["job"];
            $subject = $row["subject"];
            $phone_1 = $row["phone_1"];
            $phone_2 = $row["phone_2"];
            $email_1 = $row["e-mail_1"];
            $email_2 = $row["e-mail_2"];
            $email = $row["e-mail"];
            echo '
                <form method="post" enctype="multipart/form-data">
                    <img id="upload_image" class="upload_image" onclick="chooseFile_1()" src="' . $image . '">
                    <input class="upload_image_input" id="fileInput_1" name="fileInput_1" type="file" onchange="loadFile1(event)"></input>
                    <script>
                        function chooseFile_1() {
                            document.getElementById("fileInput_1").click();
                        } 
                        var loadFile1 = function(event) {
                            var output = document.getElementById("upload_image");
                            upload_image.src = URL.createObjectURL(event.target.files[0]);
                            upload_image.onload = function() {
                                URL.revokeObjectURL(upload_image.src) // free memory
                            }
                        };
                    </script>
                    <p id="err_p1" class="err_p"></p>
                    <input type="text" name="name" id="name" class="universal_input" placeholder="Име" autocomplete="off" value="' . $name . '">
                    <p id="err_p2" class="err_p"></p>
                    <input type="text" name="family" id="family" class="universal_input" placeholder="Фамиля" autocomplete="off" value="' . $family . '">
                    <p id="err_p3" class="err_p"></p>
                    <div type="text" id="job_btn" class="input_dropdawn_fake_input" onclick="showJobDropdown();" style="color: black;">' . $job . '</div>
                    <input type="text" name="job" id="job" class="hidden_input" value="' . $job . '">
                    <div id="job_dropdown" class="input_dropdawn">
                        <div class="input_dropdawn_btn" onclick="assignValueJob(this.innerHTML)">Директор</div>
                        <div class="input_dropdawn_btn" onclick="assignValueJob(this.innerHTML)">Заместник директор</div>
                        <div class="input_dropdawn_btn" onclick="assignValueJob(this.innerHTML)">Учител</div>
                        <div class="input_dropdawn_btn" onclick="assignValueJob(this.innerHTML)">Старши учител</div>
                        <div class="input_dropdawn_btn" onclick="assignValueJob(this.innerHTML)">Главен учител</div>
                        <div class="input_dropdawn_btn" onclick="assignValueJob(this.innerHTML)">Педагогически съветник</div>
                        <div class="input_dropdawn_btn" onclick="assignValueJob(this.innerHTML)">Училищен психолог</div>
                    </div>
                    <p id="err_p4" class="err_p"></p>
                    <input type="text" name="subject" id="subject" class="universal_input" style="cursor: pointer;" onclick="showSubjectDropdown();" placeholder="Предмет" autocomplete="off"  value="' . $subject . '">
                    <div id="subject_dropdown" class="input_dropdawn">
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">английски език</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">биология</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">български език и литература</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">география и икономика</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">изобразително изкуство</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">информационни технологии</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">испански език</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">история и цивилизации</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">музика</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">немски език</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">предприемачество</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">професионална подготовка</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">руски език</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">физика и астрономия</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">физическо възпитание и спорт</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">философия</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">френски език</div>
                        <div class="input_dropdawn_btn" onclick="assignValueSubject(this.innerHTML)">химия</div>
                    </div> 
                    <p id="err_p5" class="err_p"></p>
                    <input type="text" name="education" id="education" class="universal_input" placeholder="Образование (пр. бакалавар - специалност...)" autocomplete="off">
                    <p id="err_p_education" class="err_p"></p>
                    <div type="text" id="year_btn" class="input_dropdawn_fake_input" onmouseover="showThird3();" onmouseout="hideThird3();">Година, от която преподава в гимназията</div>
                    <input type="text" name="year" id="year" class="hidden_input">
                    <div id="years_dropdown" onmouseover="showThird3();" onmouseout="hideThird3();" class="input_dropdawn">
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2023</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2022</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2021</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2020</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2019</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2018</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2017</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2016</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2015</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2014</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2013</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2012</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2011</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2010</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2009</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2008</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2007</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2006</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2005</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2004</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2003</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2002</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2001</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">2000</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">1999</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">1998</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">1997</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">1996</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">1995</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">1994</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">1993</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">1992</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">1991</div>
                        <div class="input_dropdawn_btn" onclick="assignValueYear(this.innerHTML)">1990</div>
                    </div>
                    <p id="err_p_year" class="err_p"></p>
                    <script>
                        var subject = document.getElementById(\'subject\');
                        var subject_dropdown = document.getElementById(\'subject_dropdown\');
                        function showSubjectDropdown(){
                            subject_dropdown.style.display = "block";
                        }
                        function hideSubjectDropdown(){
                            subject_dropdown.style.display = "none";
                        }
                        function assignValueSubject(value){
                            subject_dropdown.style.display = "none";
                            subject.value = value;
                        }

                        var job = document.getElementById(\'job\');
                        var job_dropdown = document.getElementById(\'job_dropdown\');
                        var job_btn = document.getElementById(\'job_btn\');
                        function showJobDropdown(){
                            job_dropdown.style.display = "block";
                        }
                        function hideJobDropdown(){
                            job_dropdown.style.display = "none";
                        }
                        function assignValueJob(value){
                            job_dropdown.style.display = "none";
                            job_btn.style.color = "black";
                            job_btn.innerHTML = value;
                            job.value = value;
                        }

                        var year = document.getElementById(\'year\');
                        var year_btn = document.getElementById(\'year_btn\');
                        var years_dropdown = document.getElementById(\'years_dropdown\');
                        function showThird3(){
                            years_dropdown.style.display = "block";
                        }
                        function hideThird3(){
                            years_dropdown.style.display = "none";
                        }
                        function assignValueYear(value){
                            years_dropdown.style.display = "none";
                            year_btn.style.color = "black";
                            year_btn.innerHTML = value;
                            year.value = value;
                        }
                    </script>
                    <input type="text" name="phone_1" id="phone_1" class="universal_input" placeholder="Телефон 1" autocomplete="off" value="' . $phone_1 . '">
                    <input type="text" name="phone_2" id="phone_2" class="universal_input" placeholder="Телефон 2 (не е задължителен)" autocomplete="off" value="' . $phone_2 . '">
                    <p id="err_p6" class="err_p"></p>
                    <input type="text" name="e-mail_1" id="e-mail_1" class="universal_input" placeholder="E-mail 1" autocomplete="off" value="' . $email . '">
                    <input type="text" name="e-mail_2" id="e-mail_2" class="universal_input" placeholder="E-mail 2 (не е задължителен)" autocomplete="off" value="' . $email_2 . '">
                    <p id="err_p7" class="err_p"></p>
                    <input type="password" name="password" id="password" class="universal_input" placeholder="Парола" autocomplete="off">
                    <p id="err_p8" class="err_p"></p>
                    <input type="password" name="password_confirm" id="password_confirm" class="universal_input" placeholder="Повторете паролата" autocomplete="off">
                    <p id="err_p9" class="err_p"></p>
                    <input type="submit" name="submit" class="universal_submit_btn" value="Редактиране на потребител">
                </form>
            ';
            $name = $_POST["name"];
            $family = $_POST["family"];
            $job = $_POST["job"];
            $subject = $_POST["subject"];
            $education = $_POST["education"];
            $year = $_POST["year"];
            $phone_1 = $_POST["phone_1"];
            $phone_2 = $_POST["phone_2"];
            $email_1 = $_POST["e-mail_1"];
            $email_2 = $_POST["e-mail_2"];
            $password = $_POST["password"];
            $password_confirm = $_POST["password_confirm"];
            if(isset($_POST["submit"]) && $name != "" && $family != "" && $job != "" && $password != "" && $password_confirm != "" && $password == $password_confirm){
                $textName = round(microtime(true)) . '_' .  $_COOKIE["admin_panel_user_id"] . '.txt';
                $password = md5($_POST["password"]);
                $folder = '../../public_html/team/team_images/';
                if($_FILES['fileInput_1']['tmp_name']!="") {
                    unlink($folder . $image_1);
                    $temp = explode(".", $_FILES["fileInput_1"]["name"]);
                    // will be changed by the time and user's username
                    $filename1 = round(microtime(true)) . '_' . $_COOKIE["admin"] . '.' . end($temp);
                    //declaring variables
                    $filetmpname = $_FILES['fileInput_1']['tmp_name'];
                    //folder where images will be uploaded
                    //function for saving the uploaded images in a specific folder
                    move_uploaded_file($filetmpname, $folder.$filename1);
                    //inserting image details (in eg. image name) in the database
                }
                $sqlUpdate = "UPDATE `team` SET `name`='$name', `family`='$family', `e-mail`='$email_1', `password`='$password', `image`='$filename1', `job`='$job', `subject`='$subject', `education`='$education', `from_year`='$year', `phone_1`='$phone_1', `phone_2`='$phone_2', `e-mail_1`='$email_1', `e-mail_2`='$email_2' WHERE `id` = '$id'";
                if($connMain->query($sqlUpdate) === TRUE) {
                    echo "
                        <script>
                            window.location.assign('../users/');
                        </script>
                    ";
                }
            }
            if(isset($_POST["submit"])){
                if($name == ""){
                    echo '
                    <script>
                        document.getElementById("err_p2").innerHTML = "*Въведете име";
                        document.getElementById("err_p2").style.display = "block";
                    </script>
                    ';
                }
                if($family == ""){
                    echo '
                    <script>
                        document.getElementById("err_p3").innerHTML = "*Въведете фамилия";
                        document.getElementById("err_p3").style.display = "block";
                    </script>
                    ';
                }
                if($job == ""){
                    echo '
                    <script>
                        document.getElementById("err_p4").innerHTML = "*Изберете позиция";
                        document.getElementById("err_p4").style.display = "block";
                    </script>
                    ';
                }
                if($password == ""){
                    echo '
                    <script>
                        document.getElementById("err_p8").innerHTML = "*Въведи парола";
                        document.getElementById("err_p8").style.display = "block";
                    </script>
                    ';
                }
                if($password_confirm == ""){
                    echo '
                    <script>
                        document.getElementById("err_p9").innerHTML = "*Повтори паролата";
                        document.getElementById("err_p9").style.display = "block";
                    </script>
                    ';
                }
                if($password != $password_confirm){
                    echo '
                    <script>
                        document.getElementById("err_p9").innerHTML = "*Паролите не съвпадат";
                        document.getElementById("err_p9").style.display = "block";
                    </script>
                    ';
                }
            }
        ?>
    </div>
</body>
</html>