<?php
require "connection.php";

if(!empty($_GET['id']) && $_GET['edit'] == "true") {
	$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
	
	if($stmt->execute(array($_GET['id']))) {
	    $row      = $stmt->fetch();
	  
	    $id       = $row['id'];
	    $nome     = $row['nome'];
	    $email    = $row['email'];
	}

}
?>