<?php
class crud {
  private $connection;

  public function __construct(Connection $connection) {
    $this->connection = $connection; // Use the globally created connection
  }
    // Create a method to get all users    
    function getAllUsers() {
        // Query the database for all users
        $query = $this->connection->query("SELECT * FROM users");
        #$result = $query->fetch(PDO::FETCH_ASSOC);
        // Return the results as an array
        
        return $query->fetchAll();

    }
    
    function createUser($name, $email) {
        try {
          // Prepare the SQL statement
          $stmt = $this->connection->query('INSERT INTO users (name, email) VALUES (?, ?)');
    
          // Bind the parameters
          $stmt->bindParam(1, $name);
          $stmt->bindParam(2, $email);
    
          // Execute the statement
          $stmt->execute();
    
          return true; // Indicate successful creation (you can return the ID if needed)
    
        } catch(PDOException $e) {
          // Handle database error
          echo "Error creating user: " . $e->getMessage();
          return false;
        }
      }
    }

/*
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

    function getLastInsertId() {
        $connection = new Connection();
        // Assuming your database uses auto-increment IDs
        // You can customize this query based on your database type
        $stmt = $connection->query("SELECT LAST_INSERT_ID() as id");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
      }
    
      function createColor($name) {
        $connection = new Connection();
    
        try {
          // Prepare the SQL statement
          $stmt = $connection->query('INSERT INTO colors (name) VALUES (?)');
    
          // Bind the parameters
          $stmt->bindParam(1, $name);
    
          // Execute the statement
          $stmt->execute();
    
          // Get the last inserted ID using the defined method
          $lastId = $this->getLastInsertId();
    
          return $lastId; // Return the ID of the new color
    
        } catch(PDOException $e) {
          // Handle database error
          echo "Error creating color: " . $e->getMessage();
          return false;
        }
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
    */
?>
