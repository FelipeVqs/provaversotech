<?php

require_once dirname(__DIR__) . '/crud.php'; // Include the CRUD class
require_once dirname(__DIR__) . '../../connection.php'; // Include the connection class

$crud = new crud(); // Create a crud object with the connection
$colors = $crud->getAllColors();

// Check if the form was submitted and ID is present
if (isset($_POST['id'])) {
    $id = (int)$_POST['id']; // Cast to integer for safety

    $user = $crud->getUserById($id); // Fetch user by ID

    if ($user) { // Check if user exists

        // Handle form submission for editing user details (including color)
        if (isset($_POST['name'], $_POST['email'], $_POST['color'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $user_color = $_POST['user_color'];

            if ($crud->updateUser($id, $name, $email)) {
                // User updated successfully, redirect back to index with success message (optional)
                $crud->updateColor($id, $user_color);
                header('Location: ../index.php?message=success');
                exit;
            } else {
                // Update failed, display error message
                $message = 'Failed to update user!';
            }
        }
    } else {
        // User not found, display error message
        $message = 'User not found!';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Lista de Usuários</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>
</head>
<body>

<?php if (isset($message)) : ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<?php if ($user) : // Only display form if user exists   ?>
<h1>Editar Usuário (ID: <?php echo $user->id; ?>)</h1>
<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $user->id; ?>">
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" value="<?php echo $user->name; ?>">
    <br>
    <label for="email">E-mail:</label>
    <input type="text" id="email" name="email" value="<?php echo $user->email; ?>">
    <br>

    <label for="user_color">
        Cor:
        <select name="user_color" id="user_color">
            <option value="<?php echo $user->color_name; ?>">Selecione uma cor</option>
            <?php foreach ($colors as $color) {
                $frmUser .= "<option value=\"$color->name\">$color->name</option>";
            }


            $frmUser .= <<<HTML
            </select>
        </label>

        <br />
        <input type="submit" value="Atualizar" />
        <input type="reset" value="Cancelar" onclick="document.location = '../../index.php'" />
        <br />
        <br />
        <a href="../../index.php"><button type="button">Home</button></a>

        </fieldset>
    </form>


    HTML;


            echo $frmUser;
            endif; ?>

