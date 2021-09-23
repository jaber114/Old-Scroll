<?php
include('connection.php');
include('includes/login_info.php');
$current_email=$_SESSION['email'];
function check_name($name)
{
include('connection.php');
 $sql="SELECT name from usertable";
 $query=mysqli_query($con,$sql);
 while($res=mysqli_fetch_array($query))
 {
     if($res['name']==$name)
     {
        
         return true;
     }
     else
     {
         return false;
     }
 }
}
 if(isset($_POST['button']))
 {
     $user_name=$_POST['name'];
     $user_email=$_POST['email'];
     $user_message=$_POST['message'];
     $message="old scroll website";
     $contect="we will check your report."."\n"."and respond you as soon as possible";
     if($user_email==$current_email)
     {
         if(check_name($user_name)==true)
         {
 
            $query="INSERT INTO users_reports(name,email,message) VALUES ('$user_name','$user_email','$user_message')";
            $res=mysqli_query($con,$query);
         }
         else
         {
            echo "<script> alert('enter your valid name please')</script>";
         }
     }
     else
     {
        echo "<script> alert('enter your valid email')</script>";
     }
     if($res)
     {
        if(mail('oldscroll14@gmail.com',$user_email,$user_message))
        {
         echo "<script> alert('your request sended to company's mail')</script>";

        }
        else
        {
            echo "<script> alert('there was a problem sending the report to the')</script>";
        }
     }
      mysqli_close($con);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css files/contact1.css"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="javascript files/form.js"></script>
    <title>Contact form</title>
</head>
<body>
<?php
$email = $_SESSION['email'];
 include('includes/navbar.php');
?>
<div class="wrapper rounded d-flex align-items-stretch">
    <div class="bg-yellow">
        <div class="pt-5 cursive"> Please describe your product idea in a nutshell </div>
        <div class="pt-sm-5 pt-5 cursive mt-sm-5"> We need your email to reach you back </div>
    </div>
    <div class="contact-form">
        <center>
        <div style="color:orange;" class="h3">Contact Form</div>
        </center>
        <script src="javascript files/contact.js"></script>
        <form action="contact.php" method="POST" id="Form" onsubmit="check(Form)">  
            <div class="d-flex align-items-center flex-wrap justify-content-between pt-4">
                <div class="form-group pt-lg-2 pt-3"> <label for="name">Your Name</label>
				 <input type="text" name="name" class="form-control" required>
				 </div>
                <div class="form-group pt-lg-2 pt-3">
					 <label for="email">Your Email</label>
					  <input type="email" name="email" class="form-control" required>
					 </div>
            </div>
			<div class="form-group pt-3">
				 <label for="message">Message</label>
				  <textarea name="message" class="form-control" required>
				  </textarea> 
				</div>
            <div class="d-flex align-items-center flex-wrap justify-content-between pt-lg-5 mt-lg-4 mt-5">
                     <input style="color:black; background-color:orange; width: 60px; height:30px;" type="reset" value="Reset">
                <input style="color:black; background-color:orange; width: 60px; height:30px;" name="button" type="submit" value="submit" >
            </div>
        </form>
    </div>
</div> 
<br>
</body>
</html>
<?php 
include('includes/footer.php');
?>