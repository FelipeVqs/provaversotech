<?php
  ?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
</head>
<body>
  <h1>User Registration</h1>

  <form action="../helpers/saveUser.action.php" method="POST">
    <fieldset>
      <legend>Registration Form</legend>

      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
      <br>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <br>  

      <input type="submit" value="Register">
      <input type="reset" value="Reset">

    </fieldset>
  </form>
</body>
</html>
