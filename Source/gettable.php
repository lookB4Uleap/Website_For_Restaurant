<?php
    $conn = new mysqli("localhost", "root", "", "IWP PROJECT");
    if($conn->connect_error) {
        exit('Could not connect');
    }

    //echo "<script>alert();</script>";

    $date_rev=$_GET['revdate'];
    $hrs_rev=$_GET['inhrs'];
    $d=$_GET['hrs'];
    $ent=$hrs_rev-1;
    $exit=$hrs_rev+$d+1;
    $num_tab=50;
   
    for ($i=1;$i<=$num_tab;$i++) {    
        $sql="SELECT * FROM table_reserve WHERE date_rev='".$date_rev."'";
        $res=$conn->query($sql);
        $flag=0;

        if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $tab=$row["table_no"];
            if ($tab==$i and ((($row["hrs_rev"]-1)<=$ent and $ent<=($row["hrs_rev"]+$row["duration"])) 
            or (($row["hrs_rev"]-1)<=$exit and $exit<=($row["hrs_rev"]+$row["duration"])))) {
                $flag=1;
            }
        }
        }

        /*and (($row["hrs_rev"]-1<$ent and $ent<$row["hrs_rev"]+row["duration"]+1))*/

        if ($flag==0) {
            echo "<button type='button' value='".$i."' id='tab".$i."' 
            style='margin: 2px; width: 40px; background-color: yellow;' onclick='selectTab(".$i.")'>".$i."</button>";
        }

        else {
            echo "<button type='button' value='".$i."' name='tabno' id='tabno' style='margin: 2px; width: 40px'>X</button>";
        }

        if ($i%10==0)
            echo "<br>";
    
    }

?>