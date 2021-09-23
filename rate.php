<?php
include('includes/navbar.php');
include('connection.php');
include('includes/login_info.php');
$current_email=$_SESSION['email'];
function findbook($book)
{
  include('connection.php');
  $SQL="SELECT book_name from books";
  $query=mysqli_query($con,$SQL);
  while($res=mysqli_fetch_array($query))
  {
     $name=$res['book_name'];
    if($name==$book)
    {  
      return true;
    }
  }
  return false;  
}
  if(isset($_POST["rate"]))
  {
     $name=$_POST["name"];
     $book_rate=$_POST["feedback"];
     $book_name=$_POST["bname"];
     $feedback_message=$_POST["content"];
     $post_time=date("d-m-Y h:i:s");
     if($name==$current_email)
     {
       if(findbook($book_name)==true)
       {    
        $query="INSERT INTO wishlist(costumer_name,book_name,postingDate,book_rate,feedback_message) VALUES ('$name','$book_name','$post_time'
        ,'$book_rate','$feedback_message')";
        $sql_query=mysqli_query($con,$query);
        echo '<script>alert("thank you for rating the product")</script>';
        }
        else
        {
          echo '<script>alert("invalid book name")</script>';
        }
    }
     else
     {
      echo '<script>alert("this email doesnt exist on database please enter your valid email")</script>';
     }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css files/rate.css">
    <title>Rate Form</title>
  </head>
  <br>
  <body>
    <form id="form1" action="rate.php" method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Feedback Request</h3>
        </div>
        <div class="modal-body text-center">
          <i class="far fa-file-alt fa-4x mb-3 animated rotateIn icon1"></i>
          <h3>Your opinion matters</h3>
          <h5>
            Help us improve our product?
            <strong>Give us your feedback.</strong>
          </h5>
          <hr/>    
        </div>
        <div class="text-center">
          <h4>costumer email</h4>
        </div>
        <div class="text-center">
        <input type="text" id="name" name="name" required >
    </div> 
    <h4 class="text-center">book rate</h4>
        <div class="form-check mb-4">
          <input name="feedback" id="Verygood" type="radio" value="Verygood" />
          <label for="Very good" class="ml-3" style="font-size:14px; margin-top:-15px;">Very good</label>
        </div>
        <div class="form-check mb-4">
          <input name="feedback" id="good"  type="radio" value="good" />
          <label for="Good" class="ml-3" style="font-size:14px; margin-top:-15px;">Good</label>
        </div>
        <div class="form-check mb-4">
          <input name="feedback" id="Medicore" type="radio" value="Medicore" />
          <label class="ml-3" style="font-size:14px; margin-top:-15px;">Mediocre</label>
        </div>
        <div class="form-check mb-4">
          <input name="feedback" id="Bad" type="radio" value="bad" />
          <label class="ml-3" style="font-size:14px; margin-top:-15px;">Bad</label>
        </div>
        <div class="form-check mb-4">
          <input name="feedback" id="VeryBad" type="radio" value="VeryBad" />
          <label class="ml-3" style="font-size:14px; margin-top:-15px;">Very Bad</label>
        </div>
        <div class="text-center">
          <h4>What could we improve?</h4>
        </div>
        <textarea
          type="textarea"
          placeholder="Your Message"
          name="content"
          id="content"
          rows="3"
          required 
        ></textarea>
    <div class="row mb-2">
                 <div class="col-md-6">
                 <h5 style="margin-left:20px">enter book name</h5>
                 <input type="text" style="margin-left:20px" id="bname"  name="bname" id="" placeholder="book_name" class="form-control" required>
                 </div>
                 </div>
<style>
input[type=submit] 
{
  background-color: orange;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=submit]:hover {
  background-color: black;
}
</style>
        <input type="submit"  style="width:120px; margin-left:200px;" name="rate" value="rate book" value="Submit">
      </div>
    </div>
    </form>
  </body>
</html>
<?php
include('includes/footer.php');
mysqli_close($con);

?>
