<?php
    $conn = new mysqli("localhost", "root", "", "Cart");
    if($conn->connect_error) {
      exit('Could not connect');
    }
    
    $quantity=$_GET["quantity"];
    $id=$_GET["id"];
    $table="user_cart_".$_GET["q"];
    echo $table."   ".$id."     ".$quantity;
    $sql = "UPDATE ".$table." SET quantity=".$quantity." WHERE it_nm=".$id;
    $res = $conn->query($sql);
    header("Location: Cart-Page.html");
?>