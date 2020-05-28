<!-- || -->

<?php include('server.php'); // Incluí o arquivo server.php como parte do index.php

	if (isset($_GET['edit'])) { // Se a variável edit estiver definida
		$id = $_GET['edit']; // pegar o id que vai ser editado
		$edit_state = true; // Variável que define que é hora de editar é verdadeira
		$rec = mysqli_query($db, "SELECT * FROM projetos1 WHERE projeto_id=$id"); // Seleciona no banco de dados só o ID do projeto a ser editado
		$record = mysqli_fetch_array($rec); // Salva numa matriz
		$nome = $record['projeto_nome']; // Salva as variaveis corretamente
		$ident = $record['projeto_identificacao'];
		$just = $record['projeto_justificativa'];
		$eixo = $record['projeto_eixo'];
		$tipo = $record['projeto_tipo'];
		$id = $record['projeto_id'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Projetos do Smart Campus Facens num Banco de Dados SQL</title>
	<link rel="stylesheet" type="text/css" href="style.css"> <!-- Link para o arquivo css -->
</head>
<body>

	<?php if (isset($_SESSION['msg'])): ?>
		<div class="msg">
			<?php
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			?>
		</div>
	<?php endif ?> <!-- Mensagem ao usuário ao fazer alguma transação -->

	<table>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Identificação</th>
				<th>Justificativa</th>
				<th>Eixo</th>
				<th>Tipo</th>
				<th colspan="5">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($results)) { ?> <!-- Tabela local preenchida com os dados do banco -->
				<tr>					

					<td><?php echo $row['projeto_nome'] ?></td>
					<td><?php echo $row['projeto_identificacao'] ?></td>
					<td><?php echo $row['projeto_justificativa'] ?></td>
					<td><?php
						switch ($row['projeto_eixo']) {
    						case 1:
							    echo "Educação e Cultura";
							    break;
							case 2:
							    echo "Energia";
							    break;
							case 3:
							    echo "Indústria e Negócios";
							    break;
							case 4:
							    echo "Meio Ambiente";
							    break;
							case 5:
							    echo "Mobilidade e Segurança";
							    break;
							case 6:
							    echo "Saúde e Qualidade de Vida";
							    break;
							case 7:
							    echo "TIC";
							    break;
							case 8:
							    echo "Urbanização";
							    break;
							case 9:
							    echo "Governança";
							    break;
						}
					?></td>	
					<td><?php
						switch ($row['projeto_tipo']) {
    						case 1:
							    echo "Projeto Smart";
							    break;
							case 2:
							    echo "Iniciação Científica";
							    break;
							case 3:
							    echo "Trabalho de Conclusão de Curso";
							    break;						
						}
					?></td>

					<!--
					<td><?php //echo $row['projeto_eixo'] ?></td>
					<td><?php //echo $row['projeto_tipo'] ?></td>
					-->

					<td>
						<a class="edit_btn" href="index.php?edit=<?php echo $row['projeto_id']; ?>">Edit</a> <!-- Botão de editar --> 
					</td>
					<td>
						<a class="del_btn" href="server.php?del=<?php echo $row['projeto_id']; ?>">Delete</a> <!-- Botão de deletar --> 
					</td>
				</tr>
			<?php } ?>			
		</tbody>
	</table>

	<form method="post" action="server.php">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>Nome</label>
			<input type="text" name="nome" value="<?php echo $nome; ?>">
		</div>
		<div class="input-group">
			<label>Identificação</label>
			<input type="text" name="ident" value="<?php echo $ident; ?>">
		</div>
		<div class="input-group">
			<label>Justificativa</label>
			<input type="text" name="just" value="<?php echo $just; ?>">
		</div>
		<div class="select-group">
			<label>Eixo</label>
			<select type="text" name="eixo" class="ls-select" value="<?php echo $eixo; ?>">
         		<option value="1"  >Educação e Cultura</option>
          		<option value="2"  >Energia</option>
        		<option value="3"  >Indústria e Negócios</option>
        		<option value="4"  >Meio Ambiente</option>
        		<option value="5"  >Mobilidade e Segurança</option>
        		<option value="6"  >Saúde e Qualidade de Vida</option>
        		<option value="7"  >TIC</option>
        		<option value="8"  >Urbanização</option>
        		<option value="9"  >Governança</option>
        	</select>
        </div>
        <div class="select-group">
			<label>Tipo</label>
        	<select type="text" name="tipo" class="ls-select" value="<?php echo $tipo; ?>">
          		<option value="1"  >Projeto Smart</option>
          		<option value="2"  >Iniciação Científica</option>
          		<option value="3"  >Trabalho de Conclusão de Curso</option>
        	</select>
        </div>
        <div class="box-group">
	        <input type="checkbox" name="onu1" value="<?php echo $onu1; ?>">
			<label> Objetivo 1</label><br>
			<input type="checkbox" name="onu2" value="<?php echo $onu2; ?>">
			<label> Objetivo 2</label><br>
			<input type="checkbox" name="onu3" value="<?php echo $onu3; ?>">
			<label> Objetivo 3</label><br>			
		</div>

		<!-- <input type="text" name="eixo" value="<?php // echo $eixo; ?>"> --> 

		<div class="input-group">
		<?php if ($edit_state == false): ?> <!-- Se o estado de edição for falso, o botão é o de Save, caso seja verdadeiro, temos o botão de Update --> 
			<button type="submit" name="save" class="btn">Save</button>
		<?php else: ?>
			<button type="submit" name="update" class="btn">Update</button>
		<?php endif ?>

		</div>
	</form>

</body>
</html>

<!--

 <div class="ls-custom-select">
        <select id="eixo" name="eixo" class="ls-select">
          <option value="1"  >Educação e Cultura</option>
          <option value="2"  >Engergia</option>
          <option value="3"  >Indústria e Negócios</option>
          <option value="4"  >Meio Ambiente</option>
          <option value="5"  >Mobilidade e Segurança</option>
          <option value="6"  >Saúde e Qualidade de Vida</option>
          <option value="7"  >TIC</option>
          <option value="8"  >Urbanização</option>
          <option value="9"  >Governança</option>
        </select>
</div>

--> 