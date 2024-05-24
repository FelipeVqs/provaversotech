<?php
class Connection {

  private $databaseFile;
  private $connection;

  public function __construct() {
    $this->databaseFile = realpath(__DIR__ . "/database/db.sqlite");
    $this->connect();
  }

  private function connect() {
    return $this->connection = new PDO("sqlite:{$this->databaseFile}");
  }

  public function getConnection() {
    return $this->connection ?: $this->connection = $this->connect();
  }

  public function query($query) {
    try {
      $result = $this->getConnection()->query($query);
      $result->setFetchMode(PDO::FETCH_INTO, new stdClass);
      return $result;
    } catch (PDOException $e) {
      // Improved error handling
      error_log("Error executing query: " . $e->getMessage(), 3, "/path/to/error.log");
      return false; // Or throw an exception
    }
  }

  public function prepare($query) {
    try {
      $stmt = $this->getConnection()->prepare($query);
      return $stmt;
    } catch (PDOException $e) {
      // Improved error handling
      error_log("Error preparing statement: " . $e->getMessage(), 3, "/path/to/error.log");
      return false; // Or throw an exception
    }
  }
}
