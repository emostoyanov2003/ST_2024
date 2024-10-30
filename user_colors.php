<!--<?php
    $user_id = $_COOKIE["admin_panel_user_id"];
    $sqlSelect = "SELECT * FROM `users` WHERE `id` = '$user_id'";
    $result = $conn -> query($sqlSelect);
    $row = $result->fetch_assoc();
    $color = $row["color"];
    $background_color = $row["background_color"];
?>
<script>
    var elems = document.body.getElementsByTagName("*");
    for(i = 0; i < elems.length; i++){
        if(elems[i].style.color != "not specified"){
            elems[i].style.color = "<?php echo $color;?>";
        }
        if(elems[i].style.backgroundColor != "transparent" && elems[i].style.backgroundColor != "#5F8CC3"){
            elems[i].style.backgroundColor = "<?php echo $background_color;?>";
        }
        if(elems[i].style.borderColor != "#5F8CC3"){
            elems[i].style.borderColor = "<?php echo $color;?>";
        }
        document.body.style.backgroundColor = "<?php echo $background_color;?>";
    }
</script>
-->