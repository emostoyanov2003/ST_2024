<?php
    if(!isset($_COOKIE["admin_panel_user_id"]) && !isset($_COOKIE["admin_panel_user_type"])){
        echo "
        <script>
            window.location.assign('../admin');
        </script>
    ";
    }
    $user_id = $_COOKIE["admin_panel_user_id"];
    $sqlSelectUserType = "SELECT * FROM `team` WHERE MD5(`id`) = '$user_id'";
    $resultUserType = $connMain -> query($sqlSelectUserType);
    $rowUserType = $resultUserType->fetch_assoc();
    $user_type = $rowUserType["type"];
?>   <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KRZ12WMBL2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KRZ12WMBL2');
</script>
<header class="admin_menu_header" style="margin-top: -23px !important">
    <h2><i class="fa fa-school"></i> Технически университет - гр. София</h2>
    <?php
        $user_id = $_COOKIE["admin_panel_user_id"];
        $sqlSelectUser = "SELECT * FROM `team` WHERE MD5(`id`) = '$user_id'";
        $resultSelectUser = $connMain->query($sqlSelectUser);
        $rowSelectUser = $resultSelectUser->fetch_assoc();
        $image = $rowSelectUser["image"];
        $full_name = $rowSelectUser["name"] . " " . $rowSelectUser["family"];
        if ($rowSelectUser["image"] == ""){
            $image = "../admin_images/account_image.png";
        }
        echo '
        <div id="dropdown_1" class="dropdown">  
            <div class="dropbtn">
                <p class="admin_menu_header_name">' . $full_name . '</p>
                <img src="https://tcom-sf.org/team/team_images/' . $image . '" class="admin_menu_header_profile_img">
            </div>
            <div id="dropdown_content_1" class="dropdown_content animate_bounceIn">
                <div class="dropdown_content_inner_container">
                    <a href="../users_edit/?id=' . $user_id . '"><i class="fa fa-gear"></i> Настройки</a>
                    <form method="post">
                        <button name="exit"><i class="fa fa-sign-out"></i> Изход</button>
                    </form>
                </div>
            </div>
        </div>
        ';
        if(isset($_POST["exit"])){
            setcookie("admin_panel_user_id", "", time()-3600, "/");
            setcookie("admin_panel_user_type", "", time()-3600, "/");
            echo "
                <script>
                    window.location.assign('../');
                </script>
            ";
        }
    ?>
</header>
<div class="admin_menu">
    <img src="../admin_images/logo.png" class="admin_menu_img" onclick="<?php echo "window.location.assign('../home_page');"?>">
    <img src="../admin_images/powered_by_weby.png" class="admin_menu_weby_label_img" onclick="window.location.assign('https://weby.bg/');">
    <a class="admin_menu_btn" id="home_page" onclick="<?php echo "window.location.assign('../home_page');"?>"><i class="fa fa-home"></i>&nbsp;Начало</a>
    <a class="admin_menu_btn" id="teachers_room_schedule" onclick="<?php echo "window.location.assign('../rooms');"?>"><i class="fa fa-calendar"></i>&nbsp;Стаи</a>
    <?php 
        if($user_type == "admin"){
            echo '
                <a class="admin_menu_btn" id="users" onclick="window.location.assign(\'../users\');"><i class="fa fa-user-circle-o"></i>&nbsp;Потребители</a>
            ';
        }
    ?>
</div>