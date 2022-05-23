<!DOCTYPE HTML>
<html>
<head>
	<title>CRUD</title>
</head>
<?php
	require_once('connect.php');
	//iniciar o vetor de colunas
	$columns = array();
	
	//inserir as colunas que eu quero
	foreach (array('ID', 'user_login', 'user_nicename') as $x):
		array_push($columns, $x);
	endforeach;

	//escrever o sql das colunas
	$sql = "SHOW COLUMNS FROM wpoo_users WHERE Field='" . $columns[0] . "' OR Field='" . $columns[1] . "' OR Field='" . $columns[2] . "'";
	$leitura = $con->prepare($sql);
	$leitura->execute();
	$cabeca = $leitura->get_result();

	//escrever o sql dos resultados
	$sql = "SELECT " . implode(",",$columns) . " FROM wpoo_users"; 
	$leitura = $con->prepare($sql);
	$leitura->execute();
	$dados = $leitura->get_result();

?>

<body>
	<!-- 0: página de inserção -->
	<a href="add.php"> Adicionar novo usuário </a>
	<!-- x0: fim da página de inserção -->

	<!-- 1: tabela de consulta -->
	<table width="50%" border="1">

	<!-- 2: linha de cabeçalho -->
	<tr>
	<?php while ($linha = $cabeca->fetch_array()): ?>
		<?php if(is_array($linha)): ?>
			<th><?php echo $linha[0] //retorna o valor (0) referente ao nome da coluna na tabela ?></th>
		<?php endif; ?>
	<?php endwhile; ?>
	</tr>
	<!-- x2: fim da linha de cabeçalho -->

	<!-- 3: linhas restantes -->
	<?php while($linha = $dados->fetch_assoc()): ?>
		</tr>
		<?php foreach($linha as $valor): ?>
			<td><?php echo $valor ?></td>
		<?php endforeach; ?>
			<?php reset($linha); ?>
	<td><a href="edit.php?<?php echo strtolower(key($linha)); ?>=<?php echo $linha[key($linha)]; ?>"?>Editar</a> | <a href="delete.php?<?php echo strtolower(key($linha)); ?>=<?php echo $linha[key($linha)]; ?>">Apagar</a></td>
		</tr>
	<?php endwhile; ?>
	<!-- x3: fim das linhas restantes -->

	</table>
	<!-- x1: fim da tabela de consulta -->
</body>
</html>
