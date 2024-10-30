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
    ?>
    <div class="admin_page_container">
        <p class="admin_page_label">Редактиране на потребител</p>
        <?php
            error_reporting(0);
            $id = $_GET["id"];
            $sqlSelect = "SELECT * FROM `users` WHERE `id` = '$id'";
            $result = $conn -> query($sqlSelect);
            $row = $result->fetch_assoc();
            $email = $row["e-mail"];
            echo '
                <form method="post" enctype="multipart/form-data">
                    <input type="text" name="email" id="email" class="universal_input" placeholder="E-mail" autocomplete="off" value="' . $email . '">
                    <p id="err_p1" class="err_p"></p>
                    <input type="text" name="password" id="password" class="universal_input" placeholder="Парола" autocomplete="off">
                    <p id="err_p2" class="err_p"></p>
                    <input type="text" name="password_confirm" id="password_confirm" class="universal_input" placeholder="Повтори паролата" autocomplete="off">
                    <p id="err_p3" class="err_p"></p>
                    <input type="submit" name="submit" class="universal_submit_btn" value="Редактирай потребител">
                </form>
            ';
            $email = $_POST["email"];
            $password = md5($_POST["password"]);
            $password_confirm = md5($_POST["password_confirm"]);
            if(isset($_POST["submit"]) && $email != "" &&  $password != "" &&  $password_confirm != "" && $password == $password_confirm){
                $sqlUpdate = "UPDATE `users` SET `e-mail`='$email', `password`='$password', `type`='admin' WHERE `id` = '$id'";
                if($conn->query($sqlUpdate) === TRUE) {
                    echo "
                        <script>
                            window.location.assign('../users/');
                        </script>
                    ";
                }
            }
            if(isset($_POST["submit"])){
                if(!filter_var($email_1, FILTER_VALIDATE_EMAIL)) {
                    echo '
                    <script>
                        document.getElementById("err_p1").innerHTML = "*Въведете валидна електронна поща";
                        document.getElementById("err_p1").style.display = "block";
                    </script>
                    ';
                }
                if($password == ""){
                    echo '
                    <script>
                        document.getElementById("err_p1").innerHTML = "*Въведете парола";
                        document.getElementById("err_p1").style.display = "block";
                    </script>
                    ';
                }
                if($password_confirm == ""){
                    echo '
                    <script>
                        document.getElementById("err_p1").innerHTML = "*Повторете паролата";
                        document.getElementById("err_p1").style.display = "block";
                    </script>
                    ';
                }
                else if($password_confirm != $password){
                    echo '
                    <script>
                        document.getElementById("err_p1").innerHTML = "*Паролите не съвпадат";
                        document.getElementById("err_p1").style.display = "block";
                    </script>
                    ';
                }
            }
        ?>
    </div>
    <?php include "../user_colors.php";?>
</body>
</html>