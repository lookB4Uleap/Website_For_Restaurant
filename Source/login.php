<?php
    $conn = new mysqli("localhost", "root", "", "IWP PROJECT");
    if($conn->connect_error) {
        exit('Could not connect');
    }

    $email=$_POST['email'];
    $pwd=$_POST['pwd'];
    $id=-1;

    $sql="SELECT * FROM user_table";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc())  {
            if ($row['Email']==$email and $row['Password']==$pwd)
                //echo "Login Successful<br>";
            $id=$row['Id'];
        }
        echo "<script>sessionStorage.setItem('user_id',".$id.");</script>";
        echo "<script>location.href='Home.html';</script>";
    }
    
?>