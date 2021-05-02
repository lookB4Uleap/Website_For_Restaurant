<?php
    $conn = new PDO("mysql:host=localhost; dbname=order", "root", "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $con=new mysqli("localhost", "root", "", "Cart");
    if($con->connect_error) {
        exit('Could not connect');
    }

    $c=new mysqli("localhost", "root", "", "IWP PROJECT");
    if($c->connect_error) {
        exit('Could not connect');
    }

    $date=date("Y.m.d H:i:s");
    
    $table="order_user_".$_POST["q"];
    $table2="order_det_".$_POST["q"];
    $sql="INSERT INTO ".$table." (Order_Id, Name, Ph_no, Email, Address, Price) VALUES (:oid, :nm, :phno, :email, :add, :price)";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':oid', $oid);
    $stmt->bindParam(':nm', $nm);
    $stmt->bindParam(':phno', $phno);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':add',$add);
    $stmt->bindParam(':price',$price);
    
    $price=(float)$_POST['price'];
    $add=$_POST['addr'];
    $email=$_POST['email'];
    $phno=$_POST['phno'];
    $nm=$_POST['name'];
    $oid=$date."_".$_POST['q'];
    $stmt->execute();

    $query="SELECT * FROM user_cart_".$_POST['q'];

    $res = $con->query($query);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc())  {
            $sql="INSERT INTO ".$table2." (Order_Id, Item_nm, Item_pr, Item_qt, Item_sug) VALUES (:oid, :itnm, :itpr, :itqt, :itsug)";
            $stmt=$conn->prepare($sql);
            $stmt->bindParam(':oid', $oid);
            $stmt->bindParam(':itnm', $itnm);
            $stmt->bindParam(':itpr', $itpr);
            $stmt->bindParam(':itqt', $itqt);
            $stmt->bindParam(':itsug', $itsug);

            $itsug=$row['Suggestion'];
            $itqt=$row['quantity'];
            $itpr=$row['price'];
            $itnm=$row['item'];
            $oid=$date."_".$_POST['q'];
            $stmt->execute();         
            
            $sql2="UPDATE item_table SET sales=sales+".$row['quantity']." WHERE item_nm='".$row['item']."'";
            $c->query($sql2);
        }
    }

    $query="DELETE FROM user_cart_".$_POST['q'];
    $con->query($query);
    //echo $table."   ".$nm."     ".$email;
    
    echo "
        <script>
            alert('Order Placed!!! Thank You For Shopping!!!');
            location.href='Menu.html';
        </script>
        ";
?>