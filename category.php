<?php
include('includes/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="css files/card.css">
<title>Category</title>
</head>
<body>
<br><br><br>
<center>
<h1><?php echo $_GET['id']; ?> <h1>
</center>
<div class="row">
<?php
    include('connection.php');
    $id=$_GET['id'];
    $query="SELECT * FROM books WHERE book_cat='$id'";
    $sql=mysqli_query($con,$query);
    while($row=mysqli_fetch_array($sql))
    {
        $pid=$row['book_isbn']; 
    ?>
    <div class="container">
      <div class="image">
      <img src="books_images/<?php echo $row['book_cat'];?>/<?php echo $row["book_image"];?>" class="img-responsive" /><br />
      </div>
        <div class="card-content">
        <div class="wrapper">
        <p style="color:black;"><?php echo "Book Name:".$row["book_name"];?></p>
        <p style="margin-top:20px; margin-left:0px; color:black;" ><?php echo "Book Price:". $row["book_price"]; ?> ₪</p>  
        <div class="btns">
         <a href='book_detail.php?book_id=<?php echo $pid; ?>'><button name="nm" type="button">More details</button>
        </a>
        &nbsp;
          </div>
</div>
</div>
</div>
<?php
    }
?>
</div>          
 <?php
include('includes/footer.php');
mysqli_close($con);
?>   
</body>
</html>