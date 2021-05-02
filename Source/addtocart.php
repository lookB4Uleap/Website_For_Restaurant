<?php
    $conn = new PDO("mysql:host=localhost; dbname=cart", "root", "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  

    $opt=$_GET["opt"];
    
    $table="user_cart_".$_GET["q"];
    $sql="INSERT INTO ".$table." (item, item_nm,price, quantity,suggestion) VALUES (:nm, :itnm, :price, :quantity, :sug)";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':nm', $nm);
    $stmt->bindParam(':itnm', $item_nm);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':sug',$sug);
    
    $sug=$_GET['sug'];
    $quantity=$_GET["quantity"];
    $price=$_GET["price"];
    $item_nm=$_GET["item_nm"];
    $nm=$_GET["nm"];
    $stmt->execute();

    echo $table."   ".$id."     ".$quantity;
    
    if ($opt==1)
    header("Location: Cart-Page.html");
    else
    header("Location: Menu.html");
?>