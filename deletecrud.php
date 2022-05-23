<?php

	include_once("configuration.php");
	$vetor = explode(",",$_GET['id']);
	$cpf = $vetor[1];
	echo $cpf;
	$result = mysqli_query($mysqli, "DELETE FROM pessoa WHERE cpf = '$cpf'");
	//header("Location:crud.php");
	if ($result):
	else:
	echo mysqli_error($mysqli);
	endif;
?>
