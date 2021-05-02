<?php
    $conn = new mysqli("localhost", "root", "", "IWP PROJECT");
    if($conn->connect_error) {
      exit('Could not connect');
    }

    $cat = $_GET['cat'];
    $sql="SELECT * FROM item_table WHERE item_cat = '".$cat."'";
    $res=$conn->query($sql);
    $count=1;

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            if ($row['price']==$row['final_price'])
            $price = "<span>&#8377;</span>".$row['price'];
            else
            $price = "<span>&#8377;</span>".$row['final_price']." <span class='dis'><span>&#8377;</span>".$row['price']."</span>";
            $func="call('".$row['item_nm']."',".$row['final_price'].",'".$row['item_name']."')";
            echo '
            <div class="box" onclick="'.$func.'">
            <div class="image">
                <img src="Images/'.$row['item_nm'].'/'.$row['item_nm'].'_1.jpg" alt="'.$row['item_name'].'">
            </div>
            <div class="name">
                '.$row['item_name'].'
            </div>
            <div class="price">
                '.$price.'
            </div>
            </div>
            ';
            if ($count%4 == 0)
            echo "<br>";
            $count++;
        }
    }
?>