<?php

	require_once("connect.php");
	$vetor = explode(",", $_GET['id']);
	$id = $vetor[0];
	$sql = "DELETE FROM wpoo_users WHERE " . key($_GET) . "='$id'";
	$resultado = $con->prepare($sql);
	$resultado->execute();
	echo $resultado->affected_rows;
	header("Location:index.php");
?>
