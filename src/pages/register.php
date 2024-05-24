<?php
require_once dirname(__DIR__) . '/crud.php';
require_once dirname(__DIR__) . '../../connection.php'; // Include the connection class


$name = ''; // Initialize $name as an empty string
$email = ''; // Initialize $email as an empty string
$message = ''; // Initialize a variable for the status message

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];

  $crud = new crud(); // Create a new crud object

  if ($crud->createUser($name, $email)) {
    $message = 'success';
  } else {
    $message = 'fail';
  }
}



$frmUser = <<< HTML
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cadastro de Usuário</title>

</head>
<body>

<h1>Cadastro de usuário</h1>

<?php if ($message): ?>
  <p class="message"><?php echo ($message === 'success') ? 'Usuário criado com sucesso!' : 'Falha ao criar usuário!'; ?></p>
<?php endif; ?>

<form action="" method="post">
  <fieldset>
    <legend>Dados do Usuário</legend>
    
    <label for="name">
      Nome:<br />
      <input type="text" id="name" name="name" value="<?php echo $name; ?>" />
    </label>
  
  <br />
  
  <label for="email">
    E-mail:<br />
    <input type="text" id="email" name="email" value="<?php echo $email; ?>" />
  </label>
  
  <br />
  <input type="submit" value="Salvar" />
  <input type="reset" value="Cancelar" onclick="document.location = '../../index.php'" />
  
  </fieldset>
</form>

<?php
// Redirect with the status message (uncommented)
if ($message) {
  header('Location: index.php?message=' . $message);
  exit;
}
?>

</body>
</html>
HTML;
echo $frmUser;

