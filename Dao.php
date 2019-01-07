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
    $query = $conn->prepare("SELECT userID FROM users WHERE email='$email' AND pw='$password'");
    $query->execute();
    $result = $query->fetch();
    return $result; 
  }

  public function signUp($name, $email, $password){
    $email_exists =$this->checkEmail($email);
    if($email_exists){
        return NULL; 
    }else{
        $user_ID = $this->createUserID(); 
        $conn = $this->getConnection();
        $query = $conn->prepare("INSERT INTO users (userID, userName, email, pw) VALUES ('$user_ID', '$name', '$email', '$password')");
        $query->execute();
        $this->createUserTables($user_ID); 
        return $user_ID; 
    } 
  }

  private function createUserID(){
    $conn = $this->getConnection();
    $query = $conn->prepare("SELECT MAX(userID) FROM users");
    $query->execute();
    $result = $query->fetch();
    $user_ID = $result[0] + 1; 
    return $user_ID;
  }

  private function createUserTables($user_ID){
    $employee = 'employee';
    $table_name = $employee.$user_ID; 
    $conn = $this->getConnection();
    $query = $conn->prepare("CREATE TABLE $table_name (employeeID int, lastName varchar(255), firstName varchar(255), paycheck int, dependents int, deduction int)");
    $query->execute();
    $dependent = 'dependent';
    $table_name = $dependent.$user_ID; 
    $query = $conn->prepare("CREATE TABLE $table_name (employeeID int, lastName varchar(255), firstName varchar(255), deduction int)");
    $query->execute();
  }
  
  private function checkEmail($email){
    $conn = $this->getConnection(); 
    $query = $conn->prepare("SELECT email FROM users WHERE email = '$email'");
    $query->execute();
    $email_exists = $query->fetchAll();
    return $email_exists; 
  }
  
  public function newEmployee($user_ID, $first_name, $last_name, $paycheck, $dependents){
    $employee = 'employee';
    $table_name = $employee.$user_ID;
    echo $table_name; 
    $employee_ID = $this->createEmployeeID($table_name); 
    echo employee_ID; 
    $conn = $this->getConnection(); 
    $query = $conn->prepare("INSERT INTO '$table_name' (employeeID, lastName, firstName, paycheck, dependents, deduction) VALUES ('$employee_ID', '$last_name', '$first_name', $paycheck, $dependents, 1000 )");
    $query->execute();
    return $employee_ID; 
  }

  private function createEmployeeID($table_name){
    $conn = $this->getConnection();
    $query = $conn->prepare("SELECT MAX(employeeID) FROM '$table_name'");
    $query->execute();
    $result = $query->fetch();
    if($result){
      $employee_ID = $result[0] + 1; 
      return $employee_ID;
    }
    return 0; 
  }
}
?>