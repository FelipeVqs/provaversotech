<?php


// Get user data from the form submission (assuming POST method)
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';


try {
  // Validate user data (example)
  //if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  //  throw new Exception("Invalid user data");
  //}
  

  // No password field, so comment out hashing
  // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Commented out

  // Attempt to create the user (assuming your crud.php is modified)
  $result = $crud->createUser($name, $email); // Might need to modify createUser function in crud.php

  if ($result) {
    // Registration successful - redirect to index page
    redirect_to('../../index.php'); // Assuming redirect_to function is defined elsewhere 
    exit;
  } else {
    throw new Exception("Error registering user"); // Handle database error
  }
} catch (Exception $e) {
  // Handle errors (display error message, log the error)
  echo "Error registering user: " . $e->getMessage();
}

?>
