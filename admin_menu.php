<?php
    if(!isset($_COOKIE["admin_panel_user_id"]) && !isset($_COOKIE["admin_panel_user_type"])){
        echo "
        <script>
            window.location.assign('../admin');
        </script>
    ";
    }
?>
<header class="admin_menu_header" style="margin-top: -23px !important">
    <h2><i class="fa fa-school"></i> Технически университет - София</h2>
    <img src="../admin_images/addOffer_img.png" class="admin_menu_header_profile_img">
</header>
<div class="admin_menu">
    <form method="post">
        <button name="exit" class="admin_menu_exit_btn"><p class="admin_menu_exit_btn_p">Изход</p><i class="fa fa-sign-out"></i></button>
    </form>
    <?php
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
    <img src="../admin_images/logo.png" class="admin_menu_img" onclick="<?php echo "window.location.assign('../home_page');"?>">
    <img src="../admin_images/powered_by_weby.png" class="admin_menu_weby_label_img" onclick="window.location.assign('https://weby.bg/');">
    <button class="admin_menu_btn" id="home_page" onclick="<?php echo "window.location.assign('../home_page');"?>"><i class="fa fa-home"></i> Начало</button>
    <button class="admin_menu_btn" id="teachers_room_schedule" onclick="<?php echo "window.location.assign('../teachers_room_schedule');"?>"><i class="fa fa-calendar"></i> График на учителската стая</button>
    <button class="admin_menu_btn" id="users" onclick="<?php echo "window.location.assign('../users');"?>"><i class="fa fa-user-circle-o"></i> Потребители</button>
</div>