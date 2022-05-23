<html>
<head>
	<title>Adicionar</title>
</head>

<body>
	<a href="crud.php">Voltar</a>
<br /><br />

<form action="addcrud.php" method="post" name="form2">
<table width="25%" border="0">
<tr>
	<td>Nome</td>
	<td><input type="text" name="nome"></td>
</tr>
<tr>
	<td>CPF</td>
	<td><input type="text" name="cpf"></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" name="Enviar" value="Adicionar"></td>
</tr>
</table>
</form>

<?php
	if (isset($_POST['Enviar'])){
		$nome = $_POST['nome'];
		$cpf = $_POST['cpf'];

		include_once("configuration.php");

		$result = mysqli_query($mysqli, "INSERT INTO pessoa(nome, cpf) VALUES('$nome', '$cpf')");

		echo '<br />';

		if($result == false):
			echo "Erro na adição." . mysqli_error($mysqli);
		else:
			echo "Usuário adicionado com sucesso. <a href='crud.php'>Ver Usuários</a>";
		endif;
	}
?>
</body>
</html>
