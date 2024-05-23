<?php
require "connection.inc.php";

if(!empty($_POST['nome']) &&
   !empty($_POST['email']) &&
   ($_POST['edit'] == 'true')) {
	
	if($_POST['edit'] == 'true') {
		$stmt = $pdo->prepare("
			UPDATE usuarios SET 
			nome = ?,
			email = ? WHERE id = ?
		");
		
		$stmt->execute(array(
			$_POST['nome'],
			$_POST['email'],
			$_POST['id']
		));
	}
	else {
		$stmt = $pdo->prepare("
			INSERT INTO usuarios 
			(nome, email) VALUES 
			(?, ?)
		");
		
		$stmt->execute(array(
			$_POST['nome'],
			$_POST['email'],

		));
	}
	
	header("Location: index.php");
}
else {
	header("Location: frmUser.php?error=empty");
}

?>