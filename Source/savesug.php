<?php
    $conn = new mysqli("localhost", "root", "", "iwp project");
    if($conn->connect_error) {
      exit('Could not connect');
    }
    
    $email = $_POST['email'];
    $sug = $_POST['sug'];

    $sql = "INSERT INTO suggestions VALUES ('".$email."','".$sug."')";

    $conn->query($sql);
    header('Location: Home.html');
?>