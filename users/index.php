<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel | Потребители</title>
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
    ?>
    <script>
        document.getElementById("users").style.borderLeft = "2px solid";
    </script>
    <div class="admin_page_container">
        <p class="admin_page_label">Потребители</p>

        <form method="post" enctype="multipart/form-data" style="margin-top: -10px;">
        <button id="move_up_btn" name="move_up_btn" class="admin_page_control_btn"><i class="fa fa-arrow-circle-o-up"></i> Преместване нагоре</button>
        <button id="move_down_btn" name="move_down_btn" class="admin_page_control_btn"><i class="fa fa-arrow-circle-o-down"></i> Преместване надолу</button>
        <button id="delete_marked_btn" name="delete_marked_btn" class="admin_page_control_btn"><i class="fa fa-trash"></i> Изтриване</button>
        <button id="mark_all_btn" type="button" class="admin_page_control_btn" onclick="markAllRows()"><i class="fa fa-check-square"></i> Маркиране на всички</button>
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
        <button type="button" class="admin_page_control_btn" style="margin-bottom: 10px;" onclick="<?php echo "window.location.assign('../users_add');"?>"><i class="fa fa-plus-circle"></i> Добавяне</button>
        <?php
            $sql = "SELECT * FROM `users` ORDER BY `id` ASC";
            $result = $conn -> query($sql);
            $number = 1;
            while($row = $result->fetch_assoc()){
                $id = $row["id"];
                $email = $row["e-mail"];
                echo '
                    <div class="admin_page_row">
                        <label class="container">
                            <input type="checkbox" class="checkbox_input" name="chackbox_' . $id  . '">
                            <span class="checkmark"></span>
                        </label>
                        <p class="admin_page_row_p">' . $number . '. ' . $email . '</p>
                        <button type="button" class="admin_page_row_btn" onclick="window.location.assign(\'../users_edit/?id=' . $id . '\')"><i class="fa fa-pencil"></i> Редактиране</button>
                    </div>
                ';
                $number++;

                if(isset($_POST["move_up_btn"]) && isset($_POST["chackbox_" . $id])){
                    $sqlSelect = "SELECT * FROM `users`";
                    $result = $conn -> query($sqlSelect);
                    $old_id;
                    $my_id = $id;
                    $counter = 1;
                    while($row = $result->fetch_assoc()){
                        if($row["id"] == $my_id && $counter > 1){
                            $sqlUpdateRemoveOldId = "UPDATE `users` SET `id`='0' WHERE `id` = '$old_id'";
                            $sqlUpdateRemoveMyId = "UPDATE `users` SET `id`='-1' WHERE `id` = '$my_id'";
                            $conn->query($sqlUpdateRemoveOldId);
                            $conn->query($sqlUpdateRemoveMyId);
                            break;
                        }
                        else if($row["id"] == $my_id && $counter == 1){
                            echo "
                                <script>
                                    window.location.assign('');
                                </script>
                            ";
                        }
                        else{
                            $old_id = $row["id"];
                        }
                        $counter++;
                    }
                    $sqlUpdateMyId = "UPDATE `users` SET `id`='$my_id' WHERE `id` = '0'";
                    $sqlUpdateOldId = "UPDATE `users` SET `id`='$old_id' WHERE `id` = '-1'";
                    if($conn->query($sqlUpdateMyId) === TRUE && $conn->query($sqlUpdateOldId) === TRUE) {
                        echo "
                            <script>
                                window.location.assign('');
                            </script>
                        ";
                    }
                }
                if(isset($_POST["move_down_btn"]) && isset($_POST["chackbox_" . $id])){
                    error_reporting(0);
                    $sqlSelect = "SELECT * FROM `users`";
                    $result = $conn -> query($sqlSelect);
                    $future_id;
                    $my_id = $id;
                    $future = false;
                    while($row = $result->fetch_assoc()){
                        if($row["id"] == $my_id){
                            $future = true;
                        }
                        else if($future == true){
                            $future_id = $row["id"];
                            $sqlUpdateRemoveMyId = "UPDATE `users` SET `id`='-1' WHERE `id` = '$my_id'";
                            $sqlUpdateRemoveFutureId = "UPDATE `users` SET `id`='0' WHERE `id` = '$future_id'";
                            $conn->query($sqlUpdateRemoveMyId);
                            $conn->query($sqlUpdateRemoveFutureId);
                            break;
                        }
                    }
                    $sqlUpdateMyId = "UPDATE `users` SET `id`='$future_id' WHERE `id` = '-1'";
                    $sqlUpdateFutureId = "UPDATE `users` SET `id`='$my_id' WHERE `id` = '0'";
                    if($conn->query($sqlUpdateMyId) === TRUE && $conn->query($sqlUpdateFutureId) === TRUE) {
                        echo "
                            <script>
                                window.location.assign('');
                            </script>
                        ";
                    }
                }
                if(isset($_POST["delete_marked_btn"])){
                    $sqlSelect = "SELECT * FROM `users`";
                    $result = $conn -> query($sqlSelect);
                    while($row = $result->fetch_assoc()){
                        $id = $row["id"];
                        if(isset($_POST["chackbox_" . $id  . ""])){
                            $sqlDelete = "DELETE FROM `users` WHERE `id` = '$id'";
                            $conn -> query($sqlDelete);
                        }
                    }
                    echo "
                        <script>
                            window.location.assign('');
                        </script>
                    ";
                }
            }
        ?>
        </form>
    </div>
    <?php include "../user_colors.php";?>
</body>
</html>