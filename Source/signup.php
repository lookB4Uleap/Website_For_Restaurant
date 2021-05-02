<?php
    $conn1 = new mysqli("localhost", "root", "", "IWP PROJECT");
    $conn2 = new mysqli("localhost", "root", "", "cart");
    $conn3 = new mysqli("localhost", "root", "", "order");
    if($conn1->connect_error) {
        exit('Could not connect');
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $id = -1;

    

    $sql = "SELECT * FROM user_table";
    $res = $conn1->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc())  {
            if ($row['Email']==$email and $row['Password']==$pwd)
                //echo "Login Successful<br>";
            $id=$row['Id'];
        }
        echo "<script>alert('Login Successful');</script>";
        echo "<script>sessionStorage.setItem('user_id',".$id.");</script>";
        echo "<script>location.href='Menu2.html';</script>";
    }
    
    $sql = "INSERT INTO user_table(Name, Email, Password) VALUES ('".$name."','".$email."','".$pwd."')";
    $conn1->query($sql);

    $sql = "CREATE TABLE user_cart_".$id." (
        it_nm int PRIMARY KEY AUTO_INCREMENT,
        item varchar(30),
        item_nm varchar(30),
        price float, 
        quantity int,
        Suggestion text        
    )";

    $conn2->query($sql);

    $sql1 = "CREATE TABLE order_det_".$id." (
        Order_id varchar(30) PRIMARY KEY,
        Item_nm varchar(30),
        Item_pr float,
        Item_qt int,
        Item_sug text,
        Likes int DEFAULT 0
    )";

    $sql2 = "CREATE TABLE order_user_".$id." (
        Order_Id varchar(30) PRIMARY KEY,
        Name varchar(30),
        Ph_no varchar(10),
        Email text,
        Address text,
        Price float
    )";

    $conn3->query($sql1);
    $conn3->query($sql2);
    
    echo "<script>alert('Sign Up Successful! Login to continue.');</script>";
    echo "<script>location.href='LoginTemplate.html';</script>";
    //echo $id;
?>