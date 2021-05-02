<?php
    $conn = new mysqli("localhost", "root", "", "IWP PROJECT");
    if($conn->connect_error) {
      exit('Could not connect');
    }

    $item_nm = $_GET['item_nm'];
    $sql="SELECT * FROM item_table WHERE item_nm = '".$item_nm."'";
    $res=$conn->query($sql);
    
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            if ($row['price']==$row['final_price'])
            echo "<span>&#8377;</span>".$row['price'];
            else
            echo "<span>&#8377;</span>".$row['final_price']." <span class='dis'><span>&#8377;</span>".$row['price']."</span>";
            //echo $price;
        }
    }
?>