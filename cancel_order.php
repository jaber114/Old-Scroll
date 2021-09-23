<?php
include('connection.php');
if(isset($_GET['id']))
{
   $order_number=$_GET['id'];
   $sql="SELECT * From user_order Where order_number='$order_number'";
   $query=mysqli_query($con,$sql);
   while($res=mysqli_fetch_array($query))
   {
     $result=$res['order_quantity'];
     $sql2="SELECT * from books WHERE book_isbn=$res[order_isbn]";
     $query1=mysqli_query($con,$sql2);
     while($result1=mysqli_fetch_array($query1))
     {
        $result3=$result1['book_quantity']+$result;
        $sql1="update books set book_quantity='".$result3."'where book_isbn='". $res["order_isbn"]."'";
        $sql4="DELETE from user_order WHERE order_number=$order_number";
        $query3=mysqli_query($con,$sql1);
        $query4=mysqli_query($con,$sql4);
        echo '<script>window.location="costumer_order.php"</script>';
     }  
   }
}
else
{
   echo '<script> alert("didnt get the value  ") </script>';
   echo '<script>window.location="costumer_order.php"</script>';
}
mysqli_close($con);
?>