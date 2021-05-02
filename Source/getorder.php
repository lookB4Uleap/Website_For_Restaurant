<?php
    $conn = new mysqli("localhost", "root", "", "order");
    if($conn->connect_error) {
      exit('Could not connect');
    }
    
    $table="order_det_".$_GET["q"];
    //echo $table;
    $sql = "SELECT * FROM ".$table;  
    $item_no = 1;
    $like = 'like';

    $res = $conn->query($sql);  
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc())  {
            $item_nm = $row['Item_nm'];
            $para = "addLike('".$row['Item_nm']."')";
            if ($row['Likes']==1) {
                $like = 'liked';
                $para = "";
            }   
            echo '<div id="item'.$item_no.'" class="item">';
            echo '<img src="Images/'.$row['Item_nm'].'/'.$row['Item_nm'].'_1.jpg">';
            echo '<div id="name">'.$row['Item_nm'].'</div>';
            echo '<div id="cost">Cost : <span>&#8377;</span>'.$row['Item_pr'].'</div>';
            echo '<div id="quantity">Quantity : '.$row['Item_qt'].'</div>';
            echo '<button id="remove" type="button" class="btn btn-warning" onclick="'.$para.'">'.$like.'</button>';
            echo '</div>';
            $item_no+=1;
            $like = 'like';
        }
    }
    else {
        echo "<div class='item' id='item'".$item_no.">Empty";
        echo "<div id='quantity'><input type='number' style='visibility: hidden;' id='q' value='0' onchange='loadReceipt()'></div>";
        echo "<div id='cost' style='visibility: hidden;'><span>&#8377;</span>0</div>";
        echo "</div>";
    }
?>