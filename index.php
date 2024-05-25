<?php

require_once 'connection.php';
require_once 'src/crud.php';

$crud = new crud(); // Create a crud object with the connection

$users = $crud->getAllUsers(); // Fetch all users

if (empty($users)) {
    echo "Nenhum usuário encontrado.";
} else {
    // Fetch all user colors in one call
    $userColors = $crud->getAllUserColors();

    // Map color information to an associative array using user ID as key
    $colorMap = [];
    if ($userColors) {
        foreach ($userColors as $colorInfo) {
            $colorMap[$colorInfo->user_id][] = $colorInfo->color_name; // Store colors as an array for each user
        }
    }

    echo
    "<table border='1'>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Cores</th>
          <th>Ação</th>
        </tr>
      ";

    foreach($users as $user) {
        $name = isset($user->name) ? htmlspecialchars($user->name) : '';
        $email = isset($user->email) ? htmlspecialchars($user->email) : '';

        // Use colorMap to get a comma-separated list of colors for the user
        $colors = isset($colorMap[$user->id]) ? implode(', ', $colorMap[$user->id]) : 'N/A';  // Implode colors

        echo sprintf("<tr>
          <td>%s</td>
          <td>%s</td>
          <td>%s</td>
          <td>%s</td>
          <td>
            <form action='src/pages/edit.php' method='post'>
                <input type='hidden' name='id' value='%s'>
                <button type='submit'>Editar</button>
            </form>

            <form action='src/pages/remove.php' method='post'>
              <input type='hidden' name='id' value='%s'>
              <button type='submit'>Excluir</button>
            </form>
          </td>
        </tr>",
            $user->id, $name, $email, $colors, $user->id, $user->id // Include user ID in edit form
        );
    }

    echo "</table>";
}

?>
<a href="src/pages/register.php">Registrar Novo Usuário</a>
