<?php
require_once dirname(__DIR__) . '/crud.php';
require_once dirname(__DIR__) . '../../connection.php'; // Include the connection class

$name = ''; // Initialize $name as an empty string
$email = ''; // Initialize $email as an empty string
$message = ''; // Initialize a variable for the status message
$colors = []; // Initialize an empty array to store colors

$crud = new crud(); // Create a new crud object

// Fetch all available colors
$colors = $crud->getAllColors();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $color = $_POST['color']; // Assuming the selected color ID is posted

    // After inserting the user record
    if ($crud->createUser($name, $email)) {
        $message = 'success';
        $id = $crud->lastInsertId();  // Get the last inserted ID (if applicable)

        // Assuming color is selected (check if array is not empty)
        if (!empty($_POST['color'])) {
            $colorId = $_POST['color'][0]; // Assuming you want the first selected color
            $crud->createUserColor($id, $colorId);
        }
    }


}

$frmUser = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Usuário</title>
</head>
<body>

<h1>Cadastro de usuário</h1>

HTML;

if ($message) {
    $frmUser .= '<p class="message">' . (($message === 'success') ? 'Usuário criado com sucesso!' : 'Falha ao criar usuário!') . '</p>';
}

$frmUser .= <<<HTML
<head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <title>Lista de Usuários</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>
    </head>
<form action="" method="post">
  <fieldset>
    <legend>Dados do Usuário</legend>
    
    <label for="name">
      Nome:<br />
      <input type="text" id="name" name="name" value="$name" />
    </label>
  
  <br />
  
  <label for="email">
    E-mail:<br />
    <input type="text" id="email" name="email" value="$email" />
  </label>

<br />
  
  <label for="color">
  Cor:<br />
  <select name="color[]" id="color">  <option value="">Selecione uma cor</option>

HTML;
foreach ($colors as $color) {
    $frmUser .= "<option value=\"$color->name\">$color->name</option>";
}


$frmUser .= <<<HTML
    </select>
  </label>

  <br />
  <input type="submit" value="Salvar" />
  <input type="reset" value="Cancelar" onclick="document.location = '../../index.php'" />
  <br />
  <br />
  <a href="../../index.php"><button type="button">Home</button></a>

  </fieldset>
</form>

</body>
</html>
HTML;

echo $frmUser;

