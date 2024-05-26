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
    "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <title>Lista de Usuários</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>
    </head>
    <body>
      <div class='container mt-3'>
        <h1>Lista de Usuários</h1>
        <table class='table table-bordered table-hover'>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Email</th>
              <th>Cores</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>";

    foreach ($users as $user) {
        $name = isset($user->name) ? htmlspecialchars($user->name) : '';
        $email = isset($user->email) ? htmlspecialchars($user->email) : '';

        // Use colorMap to get a comma-separated list of colors for the user
        $colors = isset($colorMap[$user->id]) ? implode(', ', $colorMap[$user->id]) : 'N/A';

        echo sprintf("<tr>
              <td>%s</td>
              <td>%s</td>
              <td>%s</td>
              <td>%s</td>
              <td>
                <form action='src/pages/edit.php' method='post'>
                  <input type='hidden' name='id' value='%s'>
                  <button type='submit' class='btn btn-primary'>Editar</button>
                </form>

                <form action='src/pages/remove.php' method='post'>
                  <input type='hidden' name='id' value='%s'>
                  <button type='submit' class='btn btn-danger'>Excluir</button>
                </form>
              </td>
            </tr>",
            $user->id, $name, $email, $colors, $user->id, $user->id
        );
    }

    echo "
          </tbody>
        </table>
        <a href='src/pages/register.php' class='btn btn-success mt-3'>Registrar Novo Usuário</a>
      </div>
    </body>
    </html>";
}


