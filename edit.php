<!DOCTYPE HTML>
<html>
<head>
	</title> Editar Usuário <?php echo $_GET['id'] ?> </title>
</head>

<?php
	require_once('connect.php');
	//iniciar o vetor de colunas
	$columns = array();
	
	//inserir as colunas que eu quero
	foreach (array('ID', 'user_login', 'user_nicename') as $x):
		array_push($columns, $x);
	endforeach;

	$sql="SHOW COLUMNS FROM wpoo_users WHERE Field = '" . $columns[0] . "' OR Field='" . $columns[1] . "' OR Field='" . $columns[2] . "'";
	$leitura = $con->prepare($sql);
	$leitura->execute();
	$cabeca = $leitura->get_result();

	$sql= "SELECT " . implode(", ",$columns) . " FROM wpoo_users WHERE " . $columns[0] . "='" . $_GET['id'] . "'";
	$leitura = $con->prepare($sql);
	$leitura->execute();
	$dados = $leitura->get_result();

	$columns = array();
?>	

<body>
	<!-- 0: formulário de edição -->
	<form name="modificar" method="post" action="<?php echo $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'] ?>" >
<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . $_SERVER['QUERY_STRING']; ?> 
		<!-- educativo sobre o uso destas variáveis <?php echo $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ?> -->

		<!-- 1: tabela de edição -->
		<table width="50%" border="1">
		<tr>
			<?php while($valor = $cabeca->fetch_array()): ?>
				<?php if (is_array($valor)): ?>
					<th><?php echo $valor[0] ?></th>
					<?php array_push($columns, $valor[0]) ?>
				<?php endif; ?>
			<?php endwhile; ?>
		</tr>

		<?php while($resultados = $dados->fetch_assoc()): ?>
			<tr>
			<?php $i=0; ?>
			<?php foreach($resultados as $valor): ?>
				<td>
				<?php if($columns[$i] === 'ID'): ?>
					<input type="text" name="<?php echo $columns[$i]; ?>" value="<?php echo $valor; ?>" readonly/>
				<?php else: ?>
					<input type="text" name="<?php echo $columns[$i]; ?>" value="<?php echo $valor; ?>" />
				<?php endif; ?>
				</td>
				<?php $i++; ?>
			<?php endforeach; ?>
       			</tr>
		<?php endwhile; ?>
		<tr>
			<td>
				<input type="submit" name="Muda" value="Atualizar" />
				<input type="submit" name="Sair" value="Voltar" />
			</td>
		</tr>	

		</table>
		<!-- x1: fim da tabela de edição -->

	</form>
	<!-- x0: fim do formulário de edição -->
</body>
</html>

<?php 
	if(isset($_POST['Muda'])){
		$info = array();
		foreach ($_POST as $key=>$value){
			if ( !(in_array($key, $columns)))
				break;
			$info += [$key=>$value];
		}
		//echo implode(", ", explode(",",preg_replace('/:/','=',preg_replace('/"/','\'',json_encode($info)))));
		//echo implode(", ", $info);
		//echo '<br/>';
		$cod = reset($info);
		$cod = array(key($info) => $cod);
		//print_r(key($cod));
		unset($info[key($info)]);	
		//$string = preg_replace('/,/', ', ',trim(preg_replace('/:/',' = ',preg_replace('/"/','\'',json_encode($info))), "{}"));
		$terms = count($info);
		$string = '';
		foreach ($info as $key=>$value){
			$terms--;
			$string .= $key . " = '" . $value. "'";
			if($terms)
				$string .= ", ";
		}

					
		//echo $string;

		$sql = "UPDATE wpoo_users SET " . $string . " WHERE " . key($cod) . " = '" . $cod[key($cod)] . "'";
		echo '<br/>' . $sql . '<br/>';

		//print_r($con);
		$leitura = $con->prepare($sql);
		$leitura->execute();
		//echo $leitura->affected_rows;	
		//echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'] . "'>";
		header("Location:" . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']);
	}
	if( isset($_POST['Sair'])){
		header("Location:index.php");
	}
?>


