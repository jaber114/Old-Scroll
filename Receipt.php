<?php
include('includes/navbar.php');
include('connection.php');
include('includes/login_info.php');
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
$email=$_SESSION['email'];
$current_user=$fetch_info['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css files/receipt.css">
    <title>Receipt page</title>
</head>
<body>
<br>
<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="website logo/logo.jpg" style="width: 150%; max-width: 180px" />
								</td>
								<?php
								$request="SELECT max(order_number) as cnt from user_order";
								$query6=mysqli_query($con,$request);
								while($results=mysqli_fetch_array($query6))
								{
									$help=$results['cnt'];
								}
								$seb="SELECT buy_way,order_date FROM user_order where order_number='$help'";
								$details=mysqli_query($con,$seb);
								while($temp=mysqli_fetch_array($details))
								{
									$buy_way=$temp['buy_way'];
									$date=$temp['order_date'];
								?>
								<td>
									<div style="padding-right: 310px;">Invoice #:<?php echo $help;?></div>
									 <br />
									Order Date:<?php echo $date;?> <br />                              
								
								</td>
								<?php
								}
								?>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									Old scroll, Inc.<br />
									2496700,2491400, Yirka,Peqiin<br />
								</td>
								<td>
									<p>Costumer Name:<?php echo $current_user;?></p>
									<p>Costumer Email:<?php echo $email;?></p>
								</td>
							</tr>
						</table>
					</td>
				</tr>    
					<?php echo $buy_way;?>
				<tr class="details">
					<td>Check</td>
					<td><?php echo  $buy_way;?></td>
				</tr>           
				<tr class="heading">
					<td>Item</td>
					<td>Price</td>
				</tr>
                <?php
               $total=0;
               $res=0;	
             	foreach($_SESSION["shopping_cart"] as $keys => $values)
               	{
               ?>
				<tr class="item">
					<td><?php echo $values["item_name"];?></td>

					<td><?php echo $values["item_price"];?>₪</td>
				</tr>
              <?php
                $total+=$values["item_price"]*$values["item_quantity"];
              	 }
              ?>
				<tr class="total">
					<td></td>
					<td>Total:<?php echo $total;?>₪</td>
				</tr>
			</table>
		</div>
		<br>
		<?php
		 foreach($_SESSION["shopping_cart"] as $keys => $values)
		 {
			if($values['item_cat']=='h_digital_romantic_books' || $values['item_cat']=='E_digital_history_books' || $values['item_cat']=='E_digital_religion_books' || $values['item_cat']=='h_translate_books')
			{
		 ?>
		<?php
			}
		}
			 ?>
<?php
include('includes/footer.php');	
sleep(5);
$screen = imagegrabscreen();
$is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
if($screen)
{
	    $rand=rand(1,1999);	
		if(!empty($_SESSION['shopping_cart']))
		{
		$nameimg='files/'.$rand.'.png';
		$temp_img=$rand.'.png';
		imagepng($screen,$nameimg);
		imagepng($screen,$temp_img);
		$sql="update user_order set receipt_image='".$temp_img."'where order_number='".$help."'";
		$query=mysqli_query($con,$sql);
		include('reset_page.php');
	}
}
?>		
</body>
</html>
<?php
mysqli_close($con);
?>