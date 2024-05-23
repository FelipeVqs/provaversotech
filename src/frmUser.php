<?php require "../connection.php"; ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cadastro de Usuário</title>

</head>
<body>

<h1>Cadastro de usuário</h1>
<form action="saveUser.action.php" method="post">
	<fieldset>
		<legend>Dados do Usuário</legend>
		
		<label for="name">
			name:<br />
			<input type="text" id="name" name="name"
			 value="<?php echo $name; ?>" />
		</label>
		
		<br />
		
		<label for="email">
			E-mail:<br />
			<input type="text" id="email" name="email"
			 value="<?php echo $email; ?>" />
		</label>
		
		<br />
		
		<br />
		<br />
		
		<input type="submit" value="Salvar" />
		<input type="reset" value="Cancelar" 
		 onclick="document.location = 'index.php'" />
		
	</fieldset>
</form>

</body>
</html>