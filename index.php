<?php

require 'connection.php';
require 'crud.php';

$connection = new Connection();


$users = $connection->query("SELECT * FROM users");

$html = <<<HTML
<!DOCTYPE html>
<html>
<head>
<title>Versotech</title>
</head>
    <body>
        <form action="crud.php" method="post">
            <input type="hidden" name="id" value="<?php echo $user->id; ?>">
            <label for="name">Nome:</label>
            <input type="text" name="name" value="<?php echo $user->name; ?>">
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $user->email; ?>">
            <br>
            <input type="submit" value="Salvar">
        </form>
        <a href="crud.php?action=create">Novo Usuário</a>
    </body>
</html>
HTML;

echo $html;

/*
echo "<table border='1'>

    <tr>
        <th>ID</th>    
        <th>Nome</th>    
        <th>Email</th>
        <th>Ação</th>    
    </tr>
";

foreach($users as $user) {

    echo sprintf("<tr>
                      <td>%s</td>
                      <td>%s</td>
                      <td>%s</td>
                      <td>
                           <a href='#'>Editar</a>
                           <a href='#'>Excluir</a>
                      </td>
                   </tr>",
        $user->id, $user->name, $user->email);

}

echo "</table>";*/
?>


