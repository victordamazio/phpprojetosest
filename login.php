<!DOCTYPE html>

<!--

<?php
	session_start();

	$username = "user";
	$password = "password";

	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		header("Location: index.php");
	}

	if (isset($_POST['username']) && isset($_POST['password'])) {
		if ($_POST['username'] == $username && $_POST['password'] == $password) {
			$_SESSION['logged_in'] = true;
			header("Location: index.php");
		}
	}
?>

-->

<!-- 10:32 -->

<html>
	<head>
		<title>Tela de Login</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="frm">
			<form action="serverlogin.php" method="POST"> <!-- Chama o servidor de login --> 
				<p>
					<label>Username:</label>
					<input type="text" id="user" name="user"  />
				</p>
				<p>
					<label>Password:</label>
					<input type="password" id="pass" name="pass"  />			
				</p>
				<p>
					<input type="submit" id="btnl" value="Login"  /> <!-- Ao clicar em Login, a página serverlogin.php é chamada --> 
				</p>
			</form>
		</div>
	</body>
</html>