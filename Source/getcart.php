<?php
    $conn = new mysqli("localhost", "root", "", "Cart");
    if($conn->connect_error) {
      exit('Could not connect');
    }
    
    $table="user_cart_".$_GET["q"];
    //echo $table;
    $sql = "SELECT * FROM ".$table;  
    $item_no=1;

    $res = $conn->query($sql);  
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc())  {
            echo '<div id="item'.$item_no.'" class="item">';
            echo '<img src="Images/'.$row['item'].'/'.$row['item'].'_1.jpg">';
            echo '<div id="name">'.$row['item_nm'].'</div>';
            echo '<div id="cost"><span>&#8377;</span>'.$row['price'].'</div>';
            echo '<div id="quantity"><input type="number" name="quantity" id="q" value="'.$row['quantity'].'" onchange="changeValue('.$row['it_nm'].')"></div>';
            echo '<button id="remove" type="button" class="btn btn-warning" onclick="removeEle('.$row['it_nm'].')">Remove</button>';
            echo '</div>';
            $item_no+=1;
        }
    }
    else {
        echo "<div class='item' id='item'".$item_no.">Empty";
        echo "<div id='quantity'><input type='number' style='visibility: hidden;' id='q' value='0' onchange='loadReceipt()'></div>";
        echo "<div id='cost' style='visibility: hidden;'><span>&#8377;</span>0</div>";
        echo "</div>";
    }
?>