<!DOCTYPE html>
<html style="background-image: url('admin_images/admin_login_background.svg'); background-repeat: no-repeat; background-position: center top; background-attachment: fixed; background-size: cover;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Style_admin.css">
    <link rel="icon" href="admin_images/logo.png">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head>
<body style="margin-top: -20px; display: flex; align-items: center; justify-content: center;">
   <?php
		include "connection.php";
		if(isset($_COOKIE["admin_panel_user_id"]) && isset($_COOKIE["admin_panel_user_type"])){
			echo "
			<script>
				window.location.assign('home_page');
			</script>
		";
		}
		else{
			error_reporting(0);
			echo '
			<div class="admin_login_div" id="admin_login_div">
				<form method="post">
					<img src="admin_images/logo.png" class="admin_login_img">
					<div class="form-control">
						<input type="text" name="admin_email" required="" autocomplete="off">
						<label>
							<span style="transition-delay:0ms">e</span>
							<span style="transition-delay:50ms">-</span>
							<span style="transition-delay:100ms">m</span>
							<span style="transition-delay:150ms">a</span>
							<span style="transition-delay:200ms">i</span>
							<span style="transition-delay:250ms">l</span>
						</label>
					</div>
					<p id="err_p1" class="err_p" style="margin-left: 50px;"></p>
					<div class="form-control">
						<input type="password" name="admin_password" required="" autocomplete="off">
						<label>
							<span style="transition-delay:0ms" style="padding-left: 10px;">P</span>
							<span style="transition-delay:50ms">a</span>
							<span style="transition-delay:100ms">s</span>
							<span style="transition-delay:150ms">s</span>
							<span style="transition-delay:200ms">w</span>
							<span style="transition-delay:250ms">o</span>
							<span style="transition-delay:300ms">r</span>
							<span style="transition-delay:350ms">d</span>
						</label>
					</div>
					<p id="err_p2" class="err_p" style="margin-left: 50px;"></p>
					<input type="submit" name="submit" class="login_submit" value="Вход"></input>
				</form>
			</div>
			<script>
				function centerLoginCont(){
					var windowH = window.innerHeight;
					var marginTop = (windowH - 400) / 2;
					document.getElementById("admin_login_div").style.marginTop = marginTop + "px";
				}
				centerLoginCont();
			</script>
			';

			$emailForTB = "";
			$passwordForTB = "";
			if (isset($_POST["admin_email"]) && isset($_POST["admin_password"])) {
				// Collect value of input field
				$emailForTB = $_POST["admin_email"];
				$passwordForTB = md5($_POST["admin_password"]);
			}
			$sqlSelect = "SELECT `id`, `e-mail`, `password`, `type` FROM `team` WHERE `e-mail` = ? AND `password` = ?";
			$stmt = $connMain->prepare($sqlSelect);
            $stmt->bind_param('ss', $emailForTB, $passwordForTB);
            $stmt->execute();
			$result = $stmt->get_result();
			$rows = mysqli_num_rows($result);
			if(isset($_POST["submit"]) && $rows > 0) {
				$row = $result->fetch_assoc();
				$id = $row["id"];
				$type = $row["type"];
				setcookie("admin_panel_user_id", md5($id), time() + (86400 * 30), "/");
				setcookie("admin_panel_user_type", $type, time() + (86400 * 30), "/");
				echo "
					<script>
						function loadLogIn(){
							window.location.assign('home_page');
						}
						loadLogIn();
					</script>
				";
			}
		}
	?>
</body>
</html>