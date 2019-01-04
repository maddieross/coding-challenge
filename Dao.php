<?php

class Dao {
  private $host = "us-cdbr-iron-east-01.cleardb.net";
  private $db = "heroku_27a5636b1b521da";
  private $user = "b013e8f8c4be3a";
  private $pass = "d4ba5526";
  
  public function getConnection(){
    try {
      $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "connection successful";
      return 'connected';
    } catch (Exception $e) {
      echo "connection failed: " . $e->getMessage();
    }
  }

}
?>