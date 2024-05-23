<?php
class crud{
    // Create a method to get all users    
    function getAllUsers() {
        $connection = new Connection();
        // Query the database for all users
        $query = $connection->query("SELECT * FROM users");
        #$result = $query->fetch(PDO::FETCH_ASSOC);
        // Return the results as an array
        return $query->fetchAll();

    }
    
    function getLastInsertId() {
        $connection = new Connection();
        // Assuming your database uses auto-increment IDs
        // You can customize this query based on your database type
        $stmt = $connection->query("SELECT LAST_INSERT_ID() as id");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }
    
    function createUser($name, $email) {

        // Validate user data (example)
        if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
          throw new Exception("Invalid user data");
        }
      
        $connection = new Connection();
        $stmt = $connection->query('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
      
        if ($stmt->execute()) {
          return true; // Registration successful
        } else {
          throw new Exception("Error registering user"); // Handle database error
        }
      }
      
    

    // Create a method to get all colors
    function getAllColors() {
        $connection = new Connection();
        // Query the database for all colors
        $query = $connection->query('SELECT * FROM colors');

        // Return the results as an array
        return $query->fetchAll();
    }

    // Create a method to get all user_colors
    function getAllUserColors() {
        // Query the database for all user_colors
        $connection = new Connection();
        $query = $connection->query('SELECT * FROM user_colors');

        // Return the results as an array
        return $query->fetchAll();
    }

    // Create a method to create a new user
    

    // Create a method to create a new color
    function createColor($name) {
        // Prepare the SQL statement
        $connection = new Connection();

        $stmt = $connection->query('INSERT INTO colors (name) VALUES (?)');

        // Bind the parameters
        $stmt->bindParam(1, $name);

        // Execute the statement
        $stmt->execute();

        // Return the ID of the new color
        return getLastInsertId();
    }

    // Create a method to create a new user_color
    function createUserColor($user_id, $color_id) {
        $connection = new Connection();

        // Prepare the SQL statement
        $stmt = $connection->query('INSERT INTO user_colors (user_id, color_id) VALUES (?, ?)');

        // Bind the parameters
        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $color_id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to update a user
    function updateUser($id, $name, $email) {
        $connection = new Connection();

        // Prepare the SQL statement
        $stmt = $connection->query('UPDATE users SET name = ?, email = ? WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to update a color
    function updateColor($id, $name) {
        $connection = new Connection();

        // Prepare the SQL statement
        $stmt = $connection->query('UPDATE colors SET name = ? WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to delete a user
    function deleteUser($id) {
        $connection = new Connection();

        // Prepare the SQL statement
        $stmt = $connection->query('DELETE FROM users WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to delete a color
    function deleteColor($id) {
        $connection = new Connection();

        // Prepare the SQL statement
        $stmt = $connection->query('DELETE FROM colors WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to delete a user_color
    function deleteUserColor($user_id, $color_id) {
        $connection = new Connection();

        // Prepare the SQL statement
        $stmt = $connection->query('DELETE FROM user_colors WHERE user_id = ? AND color_id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $color_id);

        // Execute the statement
        $stmt->execute();
    }
    }
?>