<?php
    $conn1 = new mysqli("localhost", "root", "", "order");
    $conn2 = new mysqli("localhost", "root", "", "iwp project");
    if($conn1->connect_error) {
      exit('Could not connect');
    }
    
    $id=$_GET["id"];
    $table="order_det_".$_GET["q"];
    
    $sql = "SELECT * FROM ".$table;
    $res = $conn1->query($sql);
    if ($res->num_rows > 0) {
      while ($row = $res->fetch_assoc())  {
        if ($row['Item_nm'] == $id and $row['Likes']==1){
          //echo "No Update";
          $sql = "UPDATE ".$table." SET Likes = 0 WHERE Item_nm = '".$id."'";
          $conn1->query($sql);
          header("Location: Order.html");
        }
      }
    }

    echo $table."   ".$id;
    $sql = "UPDATE ".$table." SET Likes = 1 WHERE Item_nm = '".$id."'";
    $res = $conn1->query($sql);
    $like = 0;

    $sql = "SELECT * FROM item_table";
    $res = $conn2->query($sql);
    if ($res->num_rows > 0) {
      while ($row = $res->fetch_assoc())  {
        if ($row['item_nm'] == $id)
          $like = $row['likes'];
      }
    }

    $sql = "UPDATE item_table SET likes = ".($like + 1)." WHERE item_nm = '".$id."'";
    $conn2->query($sql);

    header("Location: Order.html");
?>