<?php

class Dao {
  private $host = "us-cdbr-iron-east-01.cleardb.net";
  private $db = "heroku_27a5636b1b521da";
  private $user = "b013e8f8c4be3a";
  private $pass = "d4ba5526";
  private $employee_deduction =  1000;
  private $dependent_deduction = 500; 
  private $employee = 'employee';
  private $dependent = 'dependent';
  
  private function getConnection(){
    try {
      $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    } catch (Exception $e) {
      echo "connection failed: " . $e->getMessage();
    }
  }

  public function signUp($name, $email, $password){
    $email_exists =$this->checkEmail($email);
    if($email_exists){
        return NULL; 
    }else{
        $conn = $this->getConnection();
        $query = $conn->prepare("INSERT INTO users (company, email, pw) VALUES ('$name', '$email', '$password')");
        $query->execute();
        $ID = $this->createUserTables($email); 
        return $ID; 
    } 
  }

  private function checkEmail($email){
    $conn = $this->getConnection(); 
    $query = $conn->prepare("SELECT email FROM users WHERE email = '$email'");
    $query->execute();
    $email_exists = $query->fetchAll();
    return $email_exists; 
  }

  private function createUserTables($email){
    $ID = $this->getID($email);
    /*
    $table_name = $employee.$ID; 
    $conn = $this->getConnection();
    $query = $conn->prepare("CREATE TABLE $table_name (employeeID int NOT NULL AUTO_INCREMENT, lastName varchar(255), firstName varchar(255), paycheck int, dependents int, deduction int, totalDeduction int, PRIMARY KEY (employeeID))");
    $query->execute();
    $dependent = 'dependent';
    $table_name = $dependent.$ID; 
    $query = $conn->prepare("CREATE TABLE $table_name (employeeID int, lastName varchar(255), firstName varchar(255), deduction int)");
    $query->execute();
    */
    return $ID; 
  }

  private function getID($email){
    $conn = $this->getConnection();
    $query = $conn->prepare("SELECT ID FROM users WHERE email = '$email'");
    $query->execute();
    $ID = $query->fetch();
    echo $ID; 
    return $ID[0]; 
  }

  public function loginIn($email, $password){
    $conn = $this->getConnection();
    $query = $conn->prepare("SELECT ID FROM users WHERE email='$email' AND pw='$password'");
    $query->execute();
    $results = $query->fetch();
    return $results; 
  }

  public function newEmployee($ID, $first_name, $last_name, $paycheck, $dependents){
    $employee = 'employee';
    $table_name = $this->employee.$ID;
    $employee_ID = $this->createEmployeeID($table_name); 
    $deduction = $this->getDeduction('true', $first_name); 
    $conn = $this->getConnection(); 
    $query = $conn->prepare("INSERT INTO $table_name (lastName, firstName, paycheck, dependents, deduction, totalDeduction) VALUES ('$last_name', '$first_name', '$paycheck', '$dependents', '$deduction', '$deduction' )");
    $query->execute();
    return $employee_ID; 
  }

  private function getDeduction($boolean, $first_name){
    if($boolean == 'true'){
      $deduction = $this->employee_deduction; 
    }else{
      $deduction = $this->dependent_deduction;
    }
    //discount for names beginning with A
    if($first_name[0] == 'A' || $first_name[0] == 'a'){
        return $deduction - ($deduction*.10);
    }
    return $deduction; 
  }

  public function newDependent($ID, $employee_ID, $first_name, $last_name){
    $table_name = $this->dependent.$ID;
    $deduction = $this->getDeduction('false', $first_name); 
    $conn = $this->getConnection(); 
    $query = $conn->prepare("INSERT INTO $table_name (employeeID, lastName, firstName, deduction) VALUES ('$employee_ID', '$last_name', '$first_name', '$deduction' )");
    $query->execute();
  }

  public function updateBenDeduction($ID, $employee_ID){
    //get total dependent deduction
    $table_name = $this->dependent.$ID;
    $conn = $this->getConnection(); 
    $query = $conn->prepare("SELECT SUM(deduction) FROM $table_name");
    $query->execute();
    $dependent_result = $query->fetch();
    //get employee deduction 
    $table_name = $this->employee.$ID;
    $query = $conn->prepare("SELECT deduction FROM $table_name WHERE employeeID='$employeeID");
    $query->execute();
    $employee_result = $query->fetch();
    //update total deduction
    $deduction =  $dependent_result + $employee_result;
    $query = $conn->prepare("INSERT INTO $table_name (totalDeduction) VALUES ('$deduction')");
    $query->execute();
  }

  public function getTotalBenDeduction($ID){
    $table_name = $this->employee.$ID;
    $query = $conn->prepare("SELECT SUM(totalDeduction) FROM $table_name");
    $query->execute();
    $result = $query->fetch();
    return $result;
  }

  public function displayEmployees($ID){
    $table_name = $this->employee.$ID;
    $conn = $this->getConnection(); 
    $query = $conn->prepare("SELECT employeeID, lastName, firstName FROM $table_name");
    $query->execute();
    $result = $query->fetchAll();
    return $result; 
  }
}
?>