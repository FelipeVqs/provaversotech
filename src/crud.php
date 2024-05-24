<?php

class crud {
  private $connection;

  public function __construct()
  {
    $this->connection = new connection;
  }
  
  function getLastInsertId() {

    // Assuming your database uses auto-increment IDs
    // You can customize this query based on your database type
    $stmt = $this->connection->query("SELECT LAST_INSERT_ID() as id");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['id'];
  }


function getAllUsers() {
  $stmt = $this->connection->query("SELECT * FROM users");
  $result = $stmt->fetchAll();
  return $result;
}
function createUser($name, $email) {
  try {
    //$this->connection->query('INSERT INTO users name, email VALUES (felipe,felipe@felipe.com)');
    $this->connection->query("INSERT INTO users name, email VALUES ($name, $email)");
    // Consider returning the last inserted ID if needed
    $lastId = $this->getLastInsertId();
    return $lastId; // or return true;

  } catch (PDOException $e) {
    // Improved error handling
    error_log("Error creating user: " . $e->getMessage(), 3, "/path/to/error.log");
    return false;
  }
}
    
  

    // Create a method to get all colors
    public function getAllColors() {

        // Query the database for all colors
        $query = $this->connection->query('SELECT * FROM colors');

        // Return the results as an array
        return $query->fetchAll();
    }

    // Create a method to get all user_colors
    function getAllUserColors() {
        // Query the database for all user_colors

        $query = $this->connection->query('SELECT * FROM user_colors');

        // Return the results as an array
        return $query->fetchAll();
    }

 /*
      function createColor($name) {

    
        try {
          // Prepare the SQL statement
          $stmt = $this->connection->query('INSERT INTO colors (name) VALUES (?)');
    
          // Bind the parameters
          $stmt->bindParam(1, $name);
    
          // Execute the statement
          $stmt->execute();
    
          // Get the last inserted ID using the defined method
          $lastId = getLastInsertId();
    
          return $lastId; // Return the ID of the new color
    
        } catch(PDOException $e) {
          // Handle database error
          echo "Error creating color: " . $e->getMessage();
          return false;
        }
      }
    
*/
    // Create a method to create a new user_color
    function createUserColor($user_id, $color_id) {


        // Prepare the SQL statement
        $stmt = $this->connection->query('INSERT INTO user_colors (user_id, color_id) VALUES (?, ?)');

        // Bind the parameters
        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $color_id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to update a user
    function updateUser($id, $name, $email) {


        // Prepare the SQL statement
        $stmt = $this->connection->query('UPDATE users SET name = ?, email = ? WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to update a color
    function updateColor($id, $name) {


        // Prepare the SQL statement
        $stmt = $this->connection->query('UPDATE colors SET name = ? WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to delete a user
    function deleteUser($id) {


        // Prepare the SQL statement
        $stmt = $this->connection->query('DELETE FROM users WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to delete a color
    function deleteColor($id) {


        // Prepare the SQL statement
        $stmt = $this->connection->query('DELETE FROM colors WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to delete a user_color
    function deleteUserColor($user_id, $color_id) {


        // Prepare the SQL statement
        $stmt = $this->connection->query('DELETE FROM user_colors WHERE user_id = ? AND color_id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $color_id);

        // Execute the statement
        $stmt->execute();
    }
  
	/**
	 * @return mixed
	 */
	public function getConnection() {
		return $this->connection;
	}
}
  