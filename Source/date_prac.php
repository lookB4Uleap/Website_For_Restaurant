<?php
     $conn = new mysqli("localhost", "root", "", "IWP PROJECT");
     if($conn->connect_error) {
         exit('Could not connect');
     }
    $date_rev=$_GET['revdate'];
    $hrs_rev=$_GET['inhrs'];
    $d=$_GET['hrs'];
    echo $date_rev."    ".$hrs_rev."    ".$d;
    $sql="SELECT * FROM table_reserve WHERE date_rev='".$date_rev."'";
        $res=$conn->query($sql);
        $flag=0;

        if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $tab=$row["table_no"];
            echo "<br>".$tab;
            if ($tab==1) {
                echo "<br>".$tab;
                $flag=1;
            }
        }
        }
?>