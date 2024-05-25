<?php

require_once '../../connection.php'; // Adjust path if necessary
require_once '../crud.php'; // Adjust path if necessary

$crud = new crud();

// Check if the form was submitted and ID is present
if (isset($_POST['id'])) {
    $id = (int) $_POST['id']; // Cast to integer for safety

    // Use the ID to delete the user
    $crud->deleteUser($id);

    // Redirect back to the main page with a success message (optional)
    header('Location: http://localhost/index.php?message=success');
    exit;
} else {
    // Handle case where form was not submitted or ID is missing (optional)
    echo 'Error: No user ID provided.';
}

?>
