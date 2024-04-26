<?php

/**
 * Class to perform all database based operations.
 */
class Database {

  private $sql;
  private $stmt;
  private $pdo;

  /**
   * Constructor to initialize PDO object for performing queries.
   *
   * @param string $host
   *   Host name.
   * @param string $db
   *   Database Name.
   * @param string $user
   *   Database User Name.
   * @param string $password
   *   Password of database user.
   */
  function __construct(string $host, string $db, string $user, string $password) {
    // Initializing PDO Object.
    try {
      $this->pdo = new PDO("mysql:host=$host;dbname=$db",$user,$password);
    }
    catch (Exception $e) {
      echo "Connection Failed: " . $e->getMessage();
    }

  }

  /**
   * Function to close the database connection.
   *
   * @return void
   */
  public function closeDb() {
    $this->pdo = NULL;
    $this->stmt = NULL;
  }

  /**
   * Function to insert into any table in the database.
   *
   * @param string $table_name
   *   Name of the table to insert data into.
   * @param array $column_names
   *   Column Names in the table.
   * @param array $values
   *   Values to be inserted.
   *
   * @return bool
   *   Returns true on success and false otherwise.
   */
  public function insertInto(string $table_name, array $column_names, array $values) {
    $this->sql = "INSERT INTO {$table_name} (";
    $col_len = count($column_names);
    $val_len = count($values);
    for ($i = 0; $i < $col_len; $i++) {
      $tmp = '';
      if ($i == $col_len-1) {
        $tmp = "{$column_names[$i]}) VALUES(";
      }
      else {
        $tmp = "{$column_names[$i]}, ";
      }
      $this->sql .= $tmp;
    }

    for ($i = 0; $i < $val_len; $i++) {
      $tmp = '';
      if ($i == $val_len - 1) {
        $tmp = "?);";
      }
      else {
        $tmp = "?, ";
      }
      $this->sql .= $tmp;
    }

    $this->stmt = $this->pdo->prepare($this->sql);
    try{
      return $this->stmt->execute($values);
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
  }

  /**
   * Function to update into any table with any nu,ber of values using email.
   *
   * @param string $table_name
   *   Name of the table.
   * @param array $column_names
   *   Name of columns to be updated.
   * @param array $values
   *   Values to be updated.
   * @param string $email
   *   Email to identify the updation selection.
   * @param int $id
   *   id of stock to update.
   *
   * @return bool
   *   Returns true on success and false otherwise.
   */
  public function updateInto(string $table_name, array $column_names, array $values, string $email, int $id) {
    $this->sql = "UPDATE {$table_name} SET ";
    $col_len = count($column_names);
    for ($i = 0; $i < $col_len; $i++) {
      $tmp = '';
      if ($i == $col_len - 1) {
        $tmp = "{$column_names[$i]} = '{$values[$i]}' WHERE email = '{$email}' and id = '{$id}';";
      }
      else {
        $tmp = "{$column_names[$i]} = '{$values[$i]}', ";
      }
      $this->sql .= $tmp;
    }
    $this->stmt = $this->pdo->prepare($this->sql);
    try {
      return $this->stmt->execute();
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
  }

  /**
  * Function to select a particular row from a table using email.
  *
  * @param string $table_name
  *   Table name to select from.
  * @param string $email
  *   Email id to identify row.
  *
  * @return mixed
  *  Returns array of details on success and false otherwise.
  */
  public function selectUser(string $table_name, string $email) {
  $this->sql = "SELECT * FROM {$table_name} WHERE email = '{$email}';";
  $this->stmt = $this->pdo->prepare($this->sql);
    try {
      $this->stmt->execute();
      $res = $this->stmt->fetch();
      return $res;
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
 }

  /**
   * Function to select all data from any table.
   *
   * @param string $table_name
   *   Table name to select from.
   *
   * @return mixed
   *   Returns array of details on success and false otherwise.
   */
  public function selectAll(string $table_name) {
    $this->sql = "SELECT * FROM {$table_name};";
    $this->stmt = $this->pdo->prepare($this->sql);
    try {
      $this->stmt->execute();
      $res = $this->stmt->fetchAll();
      return $res;
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
 }
 
  /**
   * Function to load stocks of a user.
   *
   * @param string $email
   *   Email id of user.
   *
   * @return array|false
   *   Returns fetched array on success and false otherwise.
   */
  public function getDefaultItems($email) {
    $this->sql = "SELECT * FROM stocks;";
    $this->stmt = $this->pdo->prepare($this->sql);
    try {
      $this->stmt->execute();
      $res = $this->stmt->fetchAll();
      return $res;
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
  }

  /**
   * Function to delete a stock.
   *
   * @param integer $id
   *   ID of the stock to be deleted
   *
   * @return bool
   *   Returns true on success and false otherwise.
   */
  public function deleteStock(int $id) {
    $this->sql = "DELETE FROM stocks WHERE id = {$id};";
    $this->stmt = $this->pdo->prepare($this->sql);
    try {
      return $this->stmt->execute();
    }
    catch (Exception $e) {
      echo "Error Occured: " . $e;
    }
  }
}
