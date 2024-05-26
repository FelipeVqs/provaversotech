<?php
include 'User.php';

class crud
{
    var $connection;

    public function __construct()
    {
        $this->connection = new connection;
    }

    function lastInsertId()
    {
        return $this->connection->getConnection()->lastInsertId();
    }


    function getAllUsers()
    {
        return $this->connection->query("SELECT * FROM users");
    }


    function getUserById($id)
    {
        // Cast ID to integer for safety
        $id = (int)$id;
        // Prepare SQL statement to select user and color information
        $sql = "SELECT u.*, uc.color_id AS user_color,c.name as color_name
FROM users u
         LEFT JOIN user_colors uc ON u.id = uc.user_id
        left join colors c on uc.color_id = c.id
          WHERE u.id = :id";

        try {
            // Prepare the statement
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->connection->prepare($sql);

            if ($stmt) { // Check if prepare was successful
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                // ... rest of your code
            }
            // Bind the ID parameter
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Execute the statement
            $stmt->execute();

            // Fetch the user data as an associative array
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                // Create a User object (adapt property names if needed)
                return new User($userData['id'], $userData['name'], $userData['email']);
            } else {
                // User not found, return null or handle it differently
                return null;
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    function createUser($name, $email)
    {
        $conn = $this->connection->getConnection(); // Get the PDO connection

        // Removed color parameter
        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $stmt = $conn->prepare($sql); // Prepare the statement

        try {
            // Bind values to the prepared statement using named parameters
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);

            $stmt->execute(); // Execute the prepared statement with bound values
            return true; // User created successfully
        } catch (PDOException $e) {
            // Improved error handling
            error_log("Error creating user: " . $e->getMessage(), 3, "/path/to/error.log");
            return false; // Or throw an exception
        }
    }


    // Create a method to get all colors
    function getAllColors()
    {

        // Query the database for all colors
        // Return the results as an array
        return $this->connection->query('SELECT * FROM colors');
    }

    // Create a method to get all user_colors
    function getAllUserColors()
    {
        // Query the database for all user_colors
        $sql = "SELECT uc.*, c.name AS color_name FROM user_colors uc LEFT JOIN colors c ON uc.color_id = c.id";

        // Return the results as an array
        return $this->connection->query('SELECT uc.*, c.name AS color_name FROM user_colors uc LEFT JOIN colors c ON uc.color_id = c.id');
    }


    // Create a method to create a new user_color
    function createUserColor($userId, $colorId)
    {
        $conn = $this->connection->getConnection(); // Get the PDO connection object
        if (!$conn) {
            // Handle connection error (log or throw exception)
            return false;
        }

        if (!$userId) { // Check if user ID is provided
            // Handle error (log or throw exception)
            return false;
        }
        $sql = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':color_id', $colorId, PDO::PARAM_INT);
        return $stmt->execute();


    }


    // Create a method to update a user
    function updateUser($id, $name, $email)
    {


        // Prepare the SQL statement
        $stmt = $this->connection->query('UPDATE users SET name = ?, email =? WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to update a color
    function updateColor($id, $name)
    {


        // Prepare the SQL statement
        $stmt = $this->connection->query('UPDATE colors SET name = ? WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to delete a user
    function deleteUser($id)
    {


        // Prepare the SQL statement
        $stmt = $this->connection->query('DELETE FROM users WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to delete a color
    function deleteColor($id)
    {


        // Prepare the SQL statement
        $stmt = $this->connection->query('DELETE FROM colors WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to delete a user_color
    function deleteUserColor($user_id, $color_id)
    {


        // Prepare the SQL statement
        $stmt = $this->connection->query('DELETE FROM user_colors WHERE user_id = ? AND color_id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $color_id);

        // Execute the statement
        $stmt->execute();
    }

}
  