<!DOCTYPE html>
<html>
<head>
	<title> Adicionar </title>
</head>

<?php 
	require_once("connect.php");

	$columns = array();

	foreach (array('ID', 'user_login', 'user_nicename') as $x):
		array_push($columns, $x);
	endforeach;

	$sql="SHOW COLUMNS FROM wpoo_users WHERE Field='" . $columns[0] . "' OR Field='" . $columns[1] . "' OR Field='" . $columns[2] . "'";

	$leitura = $con->prepare($sql);
	$leitura->execute();
	$dados = $leitura->get_result();

	$columns = array();	

?>


<body>
	<a href="index.php">Voltar</a>

	<form name="Inserir" method="post" value="Inserir" action"<?php echo $_SERVER['PHP_SELF']; ?>" >
	
		<table width='80%' border='1'>
		<?php
			while($valor = $dados->fetch_array()):
		?>
			<tr>
				<?php if(is_array($valor)): ?>
				<th><?php echo $valor[0] ?></th>
				<td><input type="text" name="<?php echo $valor[0] ?>" value="<?php echo $valor[0] ?>" /></td>
				<?php array_push($columns, $valor[0]); ?>
				<?php endif ?>
			</tr>
		<?php			
			endwhile;
		?>
		<tr>
			<td>
				<input type="submit" name="Enviar" value="Inserir"/>
			</td>
		</tr>
		</table>
	</form>
<!-- Educativo
<?php
	while ($resultados = $dados->fetch_assoc()):
		foreach ($resultados as $valor):
			if (strpos($valor, 'user')):
				echo "<p>$valor </p>";
			endif;
		endforeach;
	endwhile;
?>
-->
<br/> <br/>
</body>


<?php
	if(isset($_POST['Enviar'])):
		$info = array();
		foreach($_POST as $chave=>$valor):
			//var_dump($chave);
			if (!(in_array($chave, $columns)))
				break;
			array_push($info, $valor);
		endforeach;
		$sql = "INSERT INTO wpoo_users(" . implode(", ", $columns) . ") VALUES ('" . implode("', '",$info) . "')";
		//echo $sql;
		$leitura = $con->prepare($sql);
		$leitura->execute();
		echo $leitura->affected_rows;
	endif;	

?>
</html>
