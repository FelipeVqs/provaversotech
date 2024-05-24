<?php
require_once dirname(__DIR__) . '/crud.php';
require_once dirname(__DIR__) . '/connection.php'; // Include the connection class

$name = ''; // Initialize $name as an empty string
$email = ''; // Initialize $email as an empty string

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $connection = new Connection(); // Create a new connection
    $crud = new crud($connection); // Create a new crud object

    if ($crud->createUser($name, $email)) {
        header('Location: index.php?message=success'); // Redirect to index.php with a success message
        exit;
    } else {
        header('Location: index.php?message=fail'); // Redirect to index.php with a fail message
        exit;
    }
}

$frmUser = <<< HTML
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cadastro de Usuário</title>

</head>
<body>

<h1>Cadastro de usuário</h1>
<form action="" method="post">
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
HTML;
echo $frmUser;
?>