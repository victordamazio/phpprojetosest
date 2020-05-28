<?php

	$db = mysqli_connect('localhost', 'root', 'root', 'phpprojetos'); // Conexão com o banco de dados 
	
	$username = $_POST['user']; // Usuário e senha vindos da página de login
	$password = $_POST['pass'];

	$username = stripcslashes($username); // Segurança de usuário e senha
	$password = stripcslashes($password);
	$username = mysqli_real_escape_string($db, $username);
	$password = mysqli_real_escape_string($db, $password);
	
	$result = mysqli_query($db, "SELECT * FROM login1 WHERE login_username = '$username' AND login_password = '$password'"); // Chama a query que procura um usuário que bate com o usuário e a senha enviados
	//or die("Failed to query database ".mysql_error());
	$row = mysqli_fetch_array($result);
	if ($row['login_username'] == $username && $row['login_password'] == $password) { // Se encontrar um
		header('Location: index.php'); // Para a página de cadastro index.php
	} else {
		header('Location: login.php'); // Se não, volta para a tela de login
	}

?>