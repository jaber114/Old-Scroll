<?php 
include('connection.php');
include('includes/navbar.php');	
$message="your cart contains";
if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
	
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				
				$result=$values['item_qnt'];
				$sql_query="update books set book_quantity='".$result."'where book_isbn='". $_GET["id"]."'";
				$retval = mysqli_query($con, $sql_query);
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
			}
		}
	}
}
if(isset($_POST["checkout"]))
{
	if(!empty($_SESSION["shopping_cart"]))
	{
		echo '<script>window.location="payment.php"</script>';
	}
	else
	{
		echo '<script>alert("your cart is empty you cant go to check out")</script>';
	}
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
</head>
<body>
<style>
.w3-button {
	width:100px;
	
}
</style>
<br>
<form method="post" >
<div style="clear:both"></div>
			<br />
			<?php
			if(!empty($_SESSION["shopping_cart"]))
			{
				?>
			<center>
			<h3><?php echo $message;?></h3>
			</center>
			<?php
			}
			?>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="30%">product image</th>
            			<th width="20%">product name</th>
						<th width="10%">Quantity</th>
						<th width="5%">Price</th>
						<th width="10%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					$flag=false;
					if(!empty($_SESSION["shopping_cart"]))
					{
						
						$total = 0;
						$flag=true;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
			       <input type="hidden" name="prc" value="<?php echo $values["item_price"]; ?>" />
                   <input type="hidden" name="nm" value="<?php echo $values["item_name"]; ?>" />
				   <input type="hidden" name="img" value="<?php echo $values["item_image"]; ?>" />
				   <input type="hidden" name="id" value="<?php echo $values["item_id"]; ?>" />
					<tr>
                       <td><img src="books_images/<?php echo $values["item_cat"];?>/<?php echo $values["item_image"]; ?> " width="100" height="100"></td>
						<td><?php echo $values["item_name"]; ?></td>
						<td><h5 ><?php echo $values["item_quantity"]; ?></h5></td>
						<td>₪ <?php echo $values["item_price"]; ?><input type="hidden" class="prc" value="<?php echo $values['item_price'];?>"></td>
						<td class="total" ><?php echo $values['item_price']*$values['item_quantity'];?>₪</td>
						<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
					     $total+=$values['item_price']*$values['item_quantity'];
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right"> <?php echo $total?>₪</td>
						<td></td>
					</tr>
					<?php
					}
					else
					{
						$message="your cart is empty";	
						echo '<center>';
						echo '<h3>';
						echo $message;
						echo '</h3>';
						echo '</center>';
					}
					?>	
				</table>	
			</div>
		</div>
	</div>
	<br>
	<a>	
	<button type="submit" name="checkout"  class="btn btn-inverse btn-primary"  style="margin-left:1240px;  margin-top:-145px; width: 100px; height:39px; color:orange; background-color:orange;">check out</button>
	</a>
	</form>
	<script type="text/javascript" src="javascript files/price.js">
</script>
	<br />
</body>
</html>
<?php
include('includes/footer.php');
mysqli_close($con);
?>

