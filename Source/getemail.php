<?php
    $conn = new mysqli("localhost", "root", "", "IWP PROJECT");
    if($conn->connect_error) {
        exit('Could not connect');
    }

    $id=$_GET['q'];

    $sql="SELECT Email FROM user_table WHERE Id=".$id;
    $res=$conn->query($sql);
    $row=$res->fetch_assoc();
    echo $row['Email'];

?>