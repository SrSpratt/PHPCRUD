<?php 
	include_once("configuration.php");	
	$result = mysqli_query($mysqli, "SELECT * FROM pessoa");
	if(mysqli_connect_errno()):
		echo 'ERRO DE CONEXÃO';
	endif;
?>
<html>
<head>
	<title>CRUD - II</title>
<head>

<body>
	<a href="addcrud.php">Adicionar novo usuário</a>
		<table width='80%' border=1>

		<tr>
			<th>NOME</th><th>CPF</th>
		</tr>
		
		<?php
			while($user_data = mysqli_fetch_array($result)):
		?>
		<tr>
			<td><?php echo $user_data['nome']; ?></td>
			<td><?php echo $user_data['cpf']; ?></td>
			<td><a href="editcrud.php?id=<?php echo $user_data['nome'] . ',' . $user_data['cpf']; ?>">Editar</a> | <a href="deletecrud.php?id=<?php echo $user_data['nome'] . ',' . $user_data['cpf']; ?>">Deletar</a></td>
		</tr>
		
		<?php
			endwhile;
		?>

		</table>
</body>
</html>
