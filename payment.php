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
<h2>please fill your billing and shipping address to complete your order</h2>
</center>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form method="post" id="payment" onsubmit="return check(payment)">
      <script src="javascript files/payment1.js"></script>
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe" required>
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" type="email" id="email" name="email" placeholder="john@example.com" required>
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York" required>
            <label for="city"><i style="font-size:24px" class="fa">&#xf11d;</i> country</label>
            <input type="text" id="city" name="country" placeholder="New York" required>
            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY" required>
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001" required>
              </div>
            </div>
          </div>
          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container1">
            <i class="fa fa-cc-visa" style="color:navy;"></i>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="icon-container1">
            <i class="fa fa-cc-amex" style="color:blue;"></i>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="icon-container1">
            <i class="fa fa-cc-mastercard" style="color:red;"></i>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="icon-container1">
            <i class="fa fa-cc-discover" style="color:green;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September" required>
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018" required>
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352" required>
              </div>
            </div>
          </div>
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr" required> Shipping address same as billing
        </label>
        <input type="submit" name="check_out" value="Continue to checkout" class="btn1" required>
      </form>
      <h5 style="margin-left: 930px;" >click here if you interested for Collecting point</h5>
      <a href="pickup.php">
      <input type="submit" name="collect"  style="margin-left: 930px;" value="collection point" class="btn1" required>
      </a>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
    <?php
      if (isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart']))
      {
        $count = count($_SESSION['shopping_cart']);
     ?>
      <h4>your cart contains:<span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";?>
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
       if(isset($_POST['check_out']))
       {
         if(!empty($_SESSION['shopping_cart']))
         {
          $costumer_name=$_POST['firstname'];
          $costumer_email=$_POST['email'];
          $costumer_address=$_POST['address'];
          $costumer_city=$_POST['city'];
          $costumer_country=$_POST['country'];
          $costumer_state=$_POST['state'];
          $costumer_zip=$_POST['zip'];
          $costumer_name_on_card=$_POST['cardname'];
          $costumer_cardnumber=$_POST['cardnumber'];
          $costumer_expire_month=$_POST['expmonth'];
          $costumer_expire_year=$_POST['expyear'];
          $costumer_cvv=$_POST['cvv'];
          $sql1="INSERT INTO costumer_orders (costumer_name,email,address,city,country,state,zip,name_on_card,card_number,expire_month,expire_year,cvv)
          values
          ('$costumer_name','$costumer_email','$costumer_address','$costumer_city','$costumer_country','$costumer_state',$costumer_zip,'$costumer_name_on_card',
          '$costumer_cardnumber','$costumer_expire_month','$costumer_expire_year','$costumer_cvv')
          ";
          $query1=mysqli_query($con,$sql1);
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
            $method="payment_check";
            $sql = "INSERT  INTO user_order (order_isbn,order_quantity,order_price,
            costumer_email,order_image,order_cat,order_status,order_date,order_number,order_name)
             VALUES 
            ('$isbn','$cnt','$prc','$user_email','$img','$catg','$method','$date','$num','$temp')";
            $insert=mysqli_query($con,$sql);
          }
         }
         else
         {
          echo "<script> alert('your cart is empty there is nothing to checkout with')</script>";
         }
         echo '<script>window.location="Receipt.php"</script>';
       } 
       ?>
      <hr>
      <p>Total <span class="price" style="color:black"><b><?php echo $total;?>$</b></span></p>
    </div>
  </div>
<?php
include('includes/footer.php');
mysqli_close($con);
?>
</body>
</html>