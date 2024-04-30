<?php
require_once "databaseconnection.php";
//222003223 NIYONSHUTI Jean Pierre 
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $last_name = $_POST['last_name'];
  $first_name = $_POST['first_name'];
  $email = $_POST['email'];
  $password =$_POST['password'];
  $contact = $_POST['contact'];
  $Manager_id = $_POST['Manager_id'];
  $username = $_POST['username'];
  $sql ="INSERT INTO user_admin (last_name,first_name,email,password,contact,Manager_id,username) VALUES ('$last_name','$first_name','$email','$password','$contact','$Manager_id','$username')";
  if($connection->query($sql)==TRUE){
    echo "Registration successiful!";
      header("Location:login.html");
      exit();
  }else{
    echo "Error: ".$sql."<br>" .$connection->error;
  }
}$connection->close();
 ?>
