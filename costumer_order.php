<?php
include('connection.php');
require('includes/login_info.php');
include('includes/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>costumer order</title>
</head>
<body>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
$('#example').DataTable();
} );
</script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 100%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 100%;
  max-width: 900px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 200px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
<div class="container">
    <center>
    <div class="row header" style="margin-left:300px;color:orange">  
        <h1>Costumers Order Table</h1>   
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>order name</th>
                <th>order isbn</th>
                <th>order quantity</th>
                <th>order price</th>
                <th>order number</th>
                <th>order image</th>
                <th>order date</th>
                <th>cancel order</th>
                <th>rate a book</th>
                <th>total sum of order</th>
                <th>order recipet image</th>
                <th>pdf book</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php
            $name=$fetch_info['email'];
            $sql="SELECT * FROM user_order Where costumer_email='$name'";
            $query=mysqli_query($con,$sql);
            $sum=0;
            while($row=mysqli_fetch_array($query))
            {
             ?>
                <td><?php echo $row['order_name'];?></td>
                <td><?php echo $row['order_isbn'];?></td>
                <td><?php echo $row['order_quantity'];?></td>
                <td><?php echo $row['order_price'];?>₪</td>
                <td><?php echo $row['order_number'];?></td>
                <td>
                <img style="width:41px;" src="books_images/<?php echo $row['order_cat'];?>/<?php echo $row['order_image'];?>"
                >
                </td>
                <td><?php echo $row['order_date'];?></td>
                <?php
                   if(!($row['order_cat']=='Hebrew Digital Romantic Books' || $row['order_cat']=='English Digital History Books' || $row['order_cat']=='English Digital Religion Books' || $row['order_cat']=='Hebrew Translate Books'))
                   {
                     ?>
                <td>
                    <a href="cancel_order.php?id=<?php echo $row['order_number'];?>">cancel order</a>
                </td>
                <?php
                   }
                   else
                   {
                ?>
                <td></td>
                <?php
                   }
                   ?>
                <td>
                <a href="rate.php?">rate order</a>
                </td>
                <td><?php echo $row['order_price']*$row['order_quantity'];?></td>
                <td>
                    <img id="myImg" src="<?php echo $row['receipt_image'];?>">
                    <a href="download_image.php?idz=<?php echo $row['receipt_image'];?>">download receipt</a> 
                </td>
                <?php
                if($row['order_cat']=='Hebrew Digital Romantic Books' || $row['order_cat']=='English Digital History Books' || $row['order_cat']=='English Digital Religion Books' || $row['order_cat']=='Hebrew Translate Books')
                {
                ?>
               <td>
                   <a href="pdf_download.php?nm=<?php echo $row['order_name'];?>">download book</a>
                </td>
               <?php
                }
                else
                {
                    ?>
                    <td></td>
                    <?php
                }
               ?>
            </tr>
            <?php
            $sum+=$row["order_price"]*$row["order_quantity"];
            }
            ?>
        </tbody>
    </table>
</div>   
</body>
</html>
<?php 
include('includes/footer.php');
mysqli_close($con);
?>