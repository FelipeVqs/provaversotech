<?php

require_once 'connection.php';
require_once 'src/crud.php';

$crud = new crud(); // Create a crud object with the connection

$users = $crud->getAllUsers(); // Fetch all users

if (isset($_GET['message'])) {
  if ($_GET['message'] == 'success') {
    echo 'User created successfully!';
  } elseif ($_GET['message'] == 'fail') {
    echo 'Failed to create user!';
  }
}

echo 
  "<table border='1'>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Ação</th>
    </tr>
  ";

foreach($users as $user) {
  // Check if 'name' property exists before accessing it
  if (isset($user->name)) {
    $name = $user->name;
  } else {
    $name = ''; // Handle missing name (optional)
  }

  echo sprintf("<tr>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>
        <a href='#'>Editar</a>
        <a href='#'>Excluir</a>
      </td>
    </tr>",
    $user->id, $name, $user->email);
}

echo "</table>";

?>

<br>
<a href="src/pages/register.php">Registrar Novo Usuário</a>
