<?php

class Dao {
  private $host = "us-cdbr-iron-east-01.cleardb.net";
  private $db = "heroku_27a5636b1b521da";
  private $user = "b013e8f8c4be3a";
  private $pass = "d4ba5526";
  
  private function getConnection(){
    try {
      $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    } catch (Exception $e) {
      echo "connection failed: " . $e->getMessage();
    }
  }

  public function loginIn($email, $password){
    $conn = $this->getConnection();
    $query = $conn->prepare("SELECT * FROM users WHERE email='$email' AND pwd='$password");
    $query->execute();
    $result = $query->fetch();
    return $result; 
  }

  public function signUp($name, $email, $password){
    $email_exists =$this->checkEmail($email);
    if($email_exists){
        return NULL; 
    }else{
        $user_ID = createUserID(); 
        return $user_ID; 
        $conn = $this->getConnection();
        $query = $conn->prepare("INSERT INTO users (userID, userName, email, pw) VALUES ('$user_ID', '$name', '$email', '$password')");
        $query->execute();
        $result = $query->fetch();
        //createEmployeeTable($user_ID); 
        return $result; 
    } 
  }

  private function createUserID(){
    $conn = $this->getConnection();
    $query = $conn->prepare("SELECT MAX(userID) FROM users");
    $query->execute();
    $result = $query->fetch();
    return $result;
  }

  private function createEmployeeTable($user_ID){
    $conn = $this->getConnection();
    $query = $conn->prepare("CREATE TABLE $user_ID (employeeID int, lastName varchar(255), firstName varchar(255), paycheck int, dependents int, deduction int)");
    $query->execute();
  }
  
  private function checkEmail($email){
    $conn = $this->getConnection(); 
    $query = $conn->prepare("SELECT email FROM users WHERE email = '$email'");
    $query->execute();
    $email_exists = $query->fetchAll();
    return $email_exists; 
  }
}
?>