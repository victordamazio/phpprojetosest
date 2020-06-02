<?php	
	
	session_start(); // Começa a sessão

	$nome = ""; // Variáveis para serem inseridas no banco de dados
	$ident = "";
	$just = "";
	$eixo = "";
	$tipo = "";
	$onu1 = false;
	$onu2 = false;
	$onu3 = false;

	$id = 0; // Variável ID

	$edit_state = false; // Estado que define quando é hora de inserir algo novo no banco de dados, ou editar informação existente

	$db = mysqli_connect('localhost', 'root', 'root', 'phpprojetos'); // Conexão ao banco de dados MYSQL, localhost é o local, usuário e senha são root, e phpprojetos é o nome do banco onde está salvo os projetos

	if (isset($_POST['save'])) { // Se a página requisitou um salvamento

		$nome = $_POST['nome'];
		$ident = $_POST['ident'];
		$just = $_POST['just'];
		$eixo = $_POST['eixo'];
		$tipo = $_POST['tipo'];

		/////

		$onu1 = False;
		$onu2 = False;
		$onu3 = False;

		if (!empty($_POST['onu']))
		{
			foreach ($_POST['onu'] as $onu)
			{
				switch ($onu) {
    				case 1:
						$onu1 = True;
						break;
					case 2:
						$onu2 = True;
						break;
					case 3:
						$onu3 = True;
						break;	
				}			
			}
		}


		

		/////$onu1 = $_POST['onu1'];
		/////$onu2 = $_POST['onu2'];
		/////$onu3 = $_POST['onu3'];

		/////

		$query = "INSERT INTO projetos1 (projeto_nome, projeto_identificacao, projeto_justificativa, projeto_eixo, projeto_tipo, projeto_onu1, projeto_onu2, projeto_onu3) VALUES ('$nome', '$ident', '$just', '$eixo', '$tipo', '$onu1', '$onu2', '$onu3')"; // Query para inserir nome, identificação, justificativa e eixo no banco
		mysqli_query($db, $query); // "Rodando" a query
		$_SESSION['msg'] = "Projeto salvo"; // Mensagem de que o projeto foi salvo
		header('location: index.php'); // Atualizando a página
	}

	if (isset($_POST['update'])) { // Se a página requisitou uma atualização
		$nome = mysqli_real_escape_string($db, $_POST['nome']); // Salva a informação das caixas de texto nas variáveis
		$ident = mysqli_real_escape_string($db, $_POST['ident']);
		$just = mysqli_real_escape_string($db, $_POST['just']);
		$eixo = mysqli_real_escape_string($db, $_POST['eixo']);
		$tipo = mysqli_real_escape_string($db, $_POST['tipo']);

		///

		$onu1 = False;
		$onu2 = False;
		$onu3 = False;

		if (!empty($_POST['onu']))
		{
			foreach ($_POST['onu'] as $onu)
			{
				switch ($onu) {
    				case 1:
						$onu1 = True;
						break;
					case 2:
						$onu2 = True;
						break;
					case 3:
						$onu3 = True;
						break;	
				}			
			}
		}
		
		///
		
		$id = mysqli_real_escape_string($db, $_POST['id']);

		mysqli_query($db, "UPDATE projetos1 SET projeto_nome='$nome', projeto_identificacao='$ident', projeto_justificativa='$just', projeto_eixo='$eixo', projeto_tipo='$tipo', projeto_onu1='$onu1', projeto_onu2='$onu2', projeto_onu3='$onu3' WHERE projeto_id=$id"); // Query de atualização, mudando os dados de acordo com a ID
		$_SESSION['msg'] = "Projeto atualizado"; // Mensagem de que o projeto foi atualizado
		header('location: index.php'); // Atualizando a página
	}

	if (isset($_GET['del'])) { // Se a página requisitou informação deletada do banco
		$id = $_GET['del']; // Só é necessário da ID
		mysqli_query($db, "DELETE FROM projetos1 WHERE projeto_id=$id"); // Query para deletar
		$_SESSION['msg'] = "Projeto deletado";  // Mensagem de que o projeto foi deletado
		header('location: index.php'); // Atualiza a página
	} 

	$results = mysqli_query($db, "SELECT * FROM projetos1"); // Toda vez que a página for carregada, é necessário ler o banco de dados e enviar para a página de cadastro

?>