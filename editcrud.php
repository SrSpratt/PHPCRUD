<?php

	include_once("configuration.php");

	if(isset($_POST['Atualizar'])){
		$nome = $_POST['nome'];
		$cpf = $_POST['cpf'];

		$result = mysqli_query($mysqli, "UPDATE pessoa SET nome='$nome', cpf='$cpf' WHERE nome='$cpf'");

		header("Location: crud.php");
	}
?>
<?php
	$vetor = explode(",", $_GET['id']);
	$cpf = $vetor[1];
	$nome = $vetor[0];
	echo $cpf . '<br/>';
	$result = mysqli_query($mysqli, "SELECT * FROM pessoa WHERE cpf='$cpf'");
	if($result){}
	else { echo mysqli_error($mysqli);}
	while($user_data = mysqli_fetch_array($result)){
		$nome = $user_data['nome'];
		$cpf = $user_data['cpf'];
	}
?>
<html>
<head>
	<title>Editar</title>
</head>
<body>
	<a href="crud.php">Início</a>
	<br/><br/>

	<form name="editar_pessoa" method="post" action="editcrud.php">
	<table border="0">
	<tr>
		<td>Nome</td>
		<td><input type="text" name="nome" value=<?php echo $nome; ?>></td>
	</tr>
	<tr>
		<td>CPF</td>
		<td><input type="text" name="cpf" value=<?php echo $cpf; ?>></td>
	</tr>
	</table>
	</form>
</body>
</html>
