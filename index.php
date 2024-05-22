<?php

require 'connection.php';
require 'crud.php';

$users = getAllUsers();


$empty = $empty = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"]) || (empty($_POST["email"]))) {
      $empty = "Data is required";
    } 
    else{
        createUser($name, $email);
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
echo "</table>";
?>

$cadastro = <<<HTML
<!DOCTYPE html>
<p><span class="error">* required field</span></p>
<h1>Registeration</h1>  
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
</div>
HTML;

<php>
echo $cadastro;
</php>




