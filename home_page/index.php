<!DOCTYPE html>
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
    <p class="admin_page_label">Начало</p>
    <p class="scholarships_label">Статистика на новините</p>
    <canvas id="myChart" style="display: block; max-width: 80%; margin: 0 auto;"></canvas>
    <script>
        <?php
            $sql = "SELECT * FROM `news` ORDER BY `id` ASC";
            $result = $conn -> query($sql);
            $result1 = $conn -> query($sql);
            echo 'var xValues = [';
            while($row = $result->fetch_assoc()){
                $timestamp = $row["added_date"];
                $date = date("d-m-Y", strtotime($timestamp));
                $date = str_replace("-", ".", $date);
                echo '"' . $date . '", ';
            }
            echo '];';
            echo 'var yValues = [';
            while($row = $result1->fetch_assoc()){
                $views = $row["views"];
                echo $views . ', ';
            }
            echo '];';
        ?>
        new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0,0,255,1.0)",
            borderColor: "rgba(0,0,255,0.1)",
            data: yValues
            }]
        },
        options: {
            legend: {display: false},
        }
        });
    </script>
    </div>
    <?php include "../user_colors.php";?>
</body>
</html>