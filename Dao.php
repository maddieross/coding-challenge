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
    $table_name = $this->employee.$ID; 
    $conn = $this->getConnection();
    $query = $conn->prepare("CREATE TABLE $table_name (employeeID int NOT NULL AUTO_INCREMENT, lastName varchar(255), firstName varchar(255), paycheck int, dependents int, deduction int, totalDeduction int, PRIMARY KEY (employeeID))");
    $query->execute();
    $table_name = $this->dependent.$ID; 
    $query = $conn->prepare("CREATE TABLE $table_name (employeeID int, lastName varchar(255), firstName varchar(255), deduction int)");
    $query->execute();
    return $ID; 
  }

  private function getID($email){
    $conn = $this->getConnection();
    $query = $conn->prepare("SELECT ID FROM users WHERE email = '$email'");
    $query->execute();
    $result = $query->fetch();
    return $result[0]; 
  }

  public function loginIn($email, $password){
    $conn = $this->getConnection();
    $query = $conn->prepare("SELECT ID, company, email FROM users WHERE email='$email' AND pw='$password'");
    $query->execute();
    $results = $query->fetch();
    return $results; 
  }

  public function newEmployee($ID, $first_name, $last_name, $paycheck, $dependents){
    $table_name = $this->employee.$ID;
    $deduction = $this->getDeduction('true', $first_name); 
    $conn = $this->getConnection(); 
    $query = $conn->prepare("INSERT INTO $table_name (lastName, firstName, paycheck, dependents, deduction, totalDeduction) VALUES ('$last_name', '$first_name', '$paycheck', '$dependents', '$deduction', '$deduction')");
    $query->execute();
    $employee_ID = $this->getEmployeeID($ID);
    return $employee_ID; 
  }

  private function getEmployeeID($ID){
    $table_name = $this->employee.$ID;
    $conn = $this->getConnection(); 
    //MAX will return the last entered employee
    $query = $conn->prepare("SELECT MAX(employeeID) FROM $table_name");
    $query->execute();
    $result = $query->fetch();
    return $result[0]; 
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
    $query = $conn->prepare("SELECT SUM(deduction) FROM $table_name WHERE employeeID='$employee_ID'");
    $query->execute();
    $dependent_result = $query->fetch();
    //get employee deduction 
    $table_name = $this->employee.$ID;
    $query = $conn->prepare("SELECT deduction FROM $table_name WHERE employeeID='$employee_ID'");
    $query->execute();
    $employee_result = $query->fetch();
    //update total deduction
    $deduction =  $dependent_result[0] + $employee_result[0];
    $query = $conn->prepare("UPDATE $table_name SET totalDeduction='$deduction' WHERE employeeID='$employee_ID'");
    $query->execute();
  }

  public function previewOfCost($ID){
    $table_name = $this->employee.$ID;
    $conn = $this->getConnection(); 
    $query = $conn->prepare("SELECT lastName, firstName, paycheck, totalDeduction FROM $table_name");
    $query->execute();
    $result = $query->fetchAll();
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

  public function employeeInfo($ID, $employee_ID){
    $table_name = $this->employee.$ID;
    $conn = $this->getConnection(); 
    $query = $conn->prepare("SELECT * FROM $table_name WHERE employeeID ='$employee_ID'");
    $query->execute();
    $result = $query->fetch();
    return $result; 
  }

  public function dependentInfo($ID, $employee_ID){
    $table_name = $this->dependent.$ID;
    $conn = $this->getConnection(); 
    $query = $conn->prepare("SELECT lastName, firstName FROM $table_name WHERE employeeID ='$employee_ID'");
    $query->execute();
    $result = $query->fetchAll();
    return $result; 
  }

  public function deleteEmployee($ID, $employee_ID){
    $table_name = $this->employee.$ID;
    $conn = $this->getConnection(); 
    $query = $conn->prepare("DELETE FROM $table_name WHERE employeeID='$employee_ID'");
    $query->execute();
    $table_name = $this->dependent.$ID;
    $conn = $this->getConnection(); 
    $query = $conn->prepare("DELETE FROM $table_name WHERE employeeID='$employee_ID'");
    $query->execute();
  }

  public function updatePaycheck($ID, $employee_ID, $paycheck){
    $table_name = $this->employee.$ID;
    $conn = $this->getConnection(); 
    $query = $conn->prepare("UPDATE $table_name SET paycheck='$paycheck' WHERE employeeID='$employee_ID'");
    $query->execute();
  }

  public function deleteDependent($ID, $employee_ID, $first_name){
    $table_name = $this->dependent.$ID;
    $conn = $this->getConnection(); 
    $query = $conn->prepare("DELETE FROM $table_name WHERE firstName='$first_name' AND employeeID='$employee_ID'");
    $query->execute();
  }

  public function updateEmail($ID, $email){
    $conn = $this->getConnection(); 
    $query = $conn->prepare("UPDATE users SET email='$email' WHERE ID='$ID'");
    $query->execute();
  }

  public function updatePassword($ID, $password){
    $conn = $this->getConnection(); 
    $query = $conn->prepare("UPDATE users SET pw='$password' WHERE ID='$ID'");
    $query->execute();
  }

  public function deleteAccount($ID){
    $conn = $this->getConnection(); 
    $query = $conn->prepare("DELETE FROM users WHERE ID='$ID'");
    $query->execute();
  }

}
?>