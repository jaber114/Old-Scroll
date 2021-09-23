<?php
include('connection.php');
include('includes/navbar.php');
if(isset($_POST["track"]))
{
            $tr=$_POST['id'];
            $sql="SELECT * FROM user_order Where order_number='$tr'";
            $result=mysqli_query($con,$sql);
    
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $msg="order status is:";
                    $res= $row['order_status'];
                    echo '<script>alert("'.$res.'");</script>';
                    
                }
            }
            else
            {
                echo '<script>alert("the order id you searched for doesnt exist")</script>';
            }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css files/order_track.css">
    <title>Document</title>
</head>
<body>
    <br>
<div class="card">
    <div class="upper">
        <div class="row">
            <div class="col-8 heading">
                <h5><b>Track Your Order</b></h5>
            </div>
            <div class="col-4"> <img class="img-fluid" src="https://i.imgur.com/Rzjor3M.png"> </div>
        </div>
        <form method="post" action="order_track.php" >
            <div class="form-element">
             <span id="input-header">Order ID</span> 
            <input type="text"  name="id" placeholder="2548745588958">
             </div>
            <div class="form-element">
                <div class="row invalid">
                    <div class="col-1">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true">
                    </i> 
                </div>
                </div>
            </div>
         <input style="color:white;  background-color:orange; width: 100px;" value="track" name="track" type="submit"  >
        </form>
    </div>
    <hr>
</div>
</body>
</html>
<?php
include('includes/footer.php');
mysqli_close($con);
?>