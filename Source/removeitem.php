<?php
    $conn = new mysqli("localhost", "root", "", "Cart");
    if($conn->connect_error) {
      exit('Could not connect');
    }
    
    $id=$_GET["id"];
    $table="user_cart_".$_GET["q"];
    echo $table."   ".$id;
    $sql = "DELETE FROM ".$table." WHERE it_nm=".$id;
    $res = $conn->query($sql);
    header("Location: Cart-Page.html");
?>