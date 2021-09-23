<?php
include('includes/navbar.php');
include('includes/login_info.php');
include('connection.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css files/payment.css">
</head>
<body>
<br>
<center>
<h2>please fill your on cash delivery details</h2>
</center>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form method="post" >
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" title="two letter for name at least" pattern="[A-Za-z]{2,}+ id="fname" name="firstname" placeholder="" required>
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="email
            " title="enter a valid email syntax please"   id="email" name="email" placeholder="" required>
            <label for="adr"><i class="fa fa-address-card-o"></i> pick up Address</label>
            <input type="text" id="adr" name="address" placeholder="" required>
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" title="theree letter city at least" pattern="[A-Za-z]{3,}" id="city" name="city" placeholder="" required>
            <label for="city"><i style="font-size:24px" class="fa">&#xf11d;</i> country</label>
            <input type="text" title="Three letter country at least" pattern="[A-Za-z]{3,}" id="country" name="country" placeholder="" required>
            <label for="city"><i style="font-size:24px" class="fa">&#xf11d;</i> phone number</label>
            <input type="text" id="phone" name="phone" placeholder="" required>
            <div class="row">
            </div>
          </div>
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" name="buy" value="Continue to checkout" class="btn1">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
    <?php
      if (isset($_SESSION['shopping_cart']))
      {
        $count = count($_SESSION['shopping_cart']);
     ?>
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";?>
       </b></span></h4>
      <?php
      } 
        else
      {
          echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
      }
      ?>
      <?php 
      $total=0;				
      $res=0;
      $req="SELECT max(order_number) as cnt from user_order";
      $query6=mysqli_query($con,$req);
      while($result=mysqli_fetch_array($query6))
      {
        $num=$result['cnt'];
      }
      $num++;
      if(!empty($_SESSION["shopping_cart"]))
      {
          foreach($_SESSION["shopping_cart"] as $keys => $values)
          {
      ?>
     <p><span class="price" style="color:black"><b><?php echo $res= $values["item_price"]*$values["item_quantity"]; ?>$</b></span></p>
        <p><?php echo $values["item_name"];?> <span class="price"></span></p>
        <?php
          $total+=$res;
          }
       }
       ?>
       <?php
         if(isset($_POST['buy']))
         {
          if(!empty($_SESSION['shopping_cart']))
          {
            $costumer_name=$_POST["firstname"];
            $costumer_email=$_POST["email"];
            $costumer_address=$_POST["address"];
            $costumer_city=$_POST["city"];
            $costumer_country=$_POST["country"];
            $costumer_phone=$_POST["phone"];
            $null="hello";
            $sql_query="INSERT INTO cash_orders(costumer_name,costumer_email,costumer_country,costumer_city,costumer_address,costumer_phone,total_order)
            VALUES
            ('$costumer_name','$costumer_email','$costumer_country','$costumer_city','$costumer_address','$costumer_phone','$total')";
           $resultss= mysqli_query($con,$sql_query);
         foreach($_SESSION["shopping_cart"] as $keys => $values)
          {
            $user_email=$_SESSION['email'];
            $temp=$values["item_name"];
            $cnt=$values["item_quantity"];
            $prc=$values["item_price"];
            $img=$values["item_image"];
            $isbn=$values["item_isbn"];
            $catg=$values["item_cat"];
            $date=date("d-m-Y h:i:s");
            $method="credit-card";
            $pay_method="cash on deleivry";
            $sql = "INSERT  INTO user_order (order_isbn,order_quantity,order_price,
            costumer_email,order_image,order_cat,order_status,order_date,order_number,order_name)
             VALUES 
            ('$isbn','$cnt','$prc','$user_email','$img','$catg','$method','$date','$num','$temp')";
            $insert=mysqli_query($con,$sql);
          }
          echo '<script>window.location="Receipt.php"</script>';
        }
        else
        {
         echo "<script> alert('your cart is empty there is nothing to checkout with')</script>";
        }
      } 
       ?>
    </div>
  </div> 
<?php
include('includes/foter.php');
mysqli_close($con);
?>
</body>
</html>