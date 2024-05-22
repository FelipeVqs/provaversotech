php
// Create a new file called crud.php
// Add the following code to the top of the file:

<?php

// Include the database connection file
include 'index.php';

// Create a new class called Crud
class Crud {

    // Create a method to get all users
    public function getAllUsers() {
        // Query the database for all users
        $query = $db->query('SELECT * FROM users');

        // Return the results as an array
        return $query->fetchAll();
    }

    // Create a method to get all colors
    public function getAllColors() {
        // Query the database for all colors
        $query = $db->query('SELECT * FROM colors');

        // Return the results as an array
        return $query->fetchAll();
    }

    // Create a method to get all user_colors
    public function getAllUserColors() {
        // Query the database for all user_colors
        $query = $db->query('SELECT * FROM user_colors');

        // Return the results as an array
        return $query->fetchAll();
    }

    // Create a method to create a new user
    public function createUser($name, $email) {
        // Prepare the SQL statement
        $stmt = $db->prepare('INSERT INTO users (name, email) VALUES (?, ?)');

        // Bind the parameters
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);

        // Execute the statement
        $stmt->execute();

        // Return the ID of the new user
        return $db->lastInsertId();
    }

    // Create a method to create a new color
    public function createColor($name) {
        // Prepare the SQL statement
        $stmt = $db->prepare('INSERT INTO colors (name) VALUES (?)');

        // Bind the parameters
        $stmt->bindParam(1, $name);

        // Execute the statement
        $stmt->execute();

        // Return the ID of the new color
        return $db->lastInsertId();
    }

    // Create a method to create a new user_color
    public function createUserColor($user_id, $color_id) {
        // Prepare the SQL statement
        $stmt = $db->prepare('INSERT INTO user_colors (user_id, color_id) VALUES (?, ?)');

        // Bind the parameters
        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $color_id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to update a user
    public function updateUser($id, $name, $email) {
        // Prepare the SQL statement
        $stmt = $db->prepare('UPDATE users SET name = ?, email = ? WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to update a color
    public function updateColor($id, $name) {
        // Prepare the SQL statement
        $stmt = $db->prepare('UPDATE colors SET name = ? WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to delete a user
    public function deleteUser($id) {
        // Prepare the SQL statement
        $stmt = $db->prepare('DELETE FROM users WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to delete a color
    public function deleteColor($id) {
        // Prepare the SQL statement
        $stmt = $db->prepare('DELETE FROM colors WHERE id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $id);

        // Execute the statement
        $stmt->execute();
    }

    // Create a method to delete a user_color
    public function deleteUserColor($user_id, $color_id) {
        // Prepare the SQL statement
        $stmt = $db->prepare('DELETE FROM user_colors WHERE user_id = ? AND color_id = ?');

        // Bind the parameters
        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $color_id);

        // Execute the statement
        $stmt->execute();
    }
}
