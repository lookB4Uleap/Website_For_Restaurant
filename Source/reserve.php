<?php
    $conn = new mysqli("localhost", "root", "", "IWP PROJECT");
    if($conn->connect_error) {
        exit('Could not connect');
    }

    $tabno=(int)$_POST['tabno'];
    $name=$_POST['nm'];
    $phno=$_POST['phno'];
    $email=$_POST['email'];
    $date_rev=$_POST['revdate'];
    $hrs_rev=$_POST['inhrs'];
    $min_rev=$_POST['inmin'];
    $d=$_POST['hrs'];

    $sql="INSERT INTO table_reserve(table_no, name, phno, email, date_rev, hrs_rev, min_rev, duration) VALUES (".$tabno.",'".$name."','".$phno."','".$email."','".$date_rev."',".$hrs_rev.",".$min_rev.",".$d.")";
    $conn->query($sql);

    echo "
        <script>
            alert('Table Reserved');
            location.href='Menu.html';
        </script>
    ";
?>