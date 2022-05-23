<?php
	//lê o arquivo de configuração com as constantes de conexão
	require_once('config.php');

	//inicia um objeto do tipo mysqli para abrir a conexão
	$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	//condicional que verifica se a conexão tece sucesso ou não
	if ($con->connect_error)
		die('Falha na conexão: ' . $con->connect_error);
	else
		echo 'Conectado!';
?>
