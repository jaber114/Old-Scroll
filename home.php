
<?php 
require_once('controllerUserData.php');
include('connection.php');
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>old scroll</title>
    <link rel="stylesheet" href="css files/category_css.css">
    <link rel="stylesheet" href="css files/bootstrap.min.css">
    <link rel="stylesheet" href="css files/templatemo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel = "icon" href =  "website logo/logo.jpg" type = "image/x-icon">   
</head>
<style>
#image{
    width:fixed;
    height:250px;
}
    </style>
<body>
<?php include('includes/navbar.php');
 ?>
<br><br><br><br>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="bg-image" style="text-align:right;">      
<center>
    <img class="mySlides" src="boo1.jpg" width="1050px" height="200px"> 
    <img class="mySlides" src="boo3.jpg" width="1050px" height="200px">
    <img class="mySlides" src="boo4.jpg" width="1050px" height="200px"> 
    <img class="mySlides" src="boo5.jpg" width="1050px" height="200px">
    <img class="mySlides" src="boo6.jpg" width="1050px" height="200px"> 
    </center>
    </div>
    <script>
    var myIndex = 0;
     carousel();
     function carousel() {
     var i;
     var x = document.getElementsByClassName("mySlides");
     for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";
          }
          myIndex++;
     if (myIndex > x.length) { myIndex = 1 }
         x[myIndex - 1].style.display = "block";
         setTimeout(carousel, 10000); // Change image every 2 seconds
        }
    </script>
<style>
    .blog .carousel-indicators {
	left: 0;
	top: auto;
    bottom: -40px;

}
/* The colour of the indicators */
.blog .carousel-indicators li {
    background: #a3a3a3;
    border-radius: 50%;
    width: 8px;
    height: 8px;
}

.blog .carousel-indicators .active {
background: white;
}

#image 
{
  height:70%;
  width:70%;
}
    </style>
<br><br>
<?php include('cardslider.php');?>
 <center>
    <h1>Shop by Category</h1>
    <center>
<hr>
        <section class="container overflow-hidden py-5">
            <div class="row gx-5 gx-sm-3 gx-lg-5 gy-lg-5 gy-3 pb-3 projects">
                <div class="col-xl-3 col-md-4 col-sm-6 project ui branding">
                    <a href="hebrew.php" class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                        <img class="service card-img" src="cat1.jpg" height="280px" alt="Card image">
                        <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                            <div class="service-work-content text-left text-light">
                                <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">Hebrew books</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-4 col-sm-6 project ui graphic">
                    <a href="english.php" class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                        <img class="card-img" src="cat2.jpg" height="280px" alt="Card image">
                        <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                            <div class="service-work-content text-left text-light">
                                <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">English books</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-4 col-sm-6 project branding">
                    <a href="hebrew digital books.php" class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                        <img class="card-img" src="cat3.jpeg" height="280px" alt="Card image">
                        <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                            <div class="service-work-content text-left text-light">
                                <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">E-books in Hebrew</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-4 col-sm-6 project ui graphic">
                    <a href="english digital books.php" class="service-work card border-0 text-white shadow-sm overflow-hidden mx-5 m-sm-0">
                        <img class="card-img" src="cat4.jpeg" height="380px" alt="Card image">
                        <div class="service-work-vertical card-img-overlay d-flex align-items-end">
                            <div class="service-work-content text-left text-light">
                                <span class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300">E-books in english</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    </section>
<br><br>
</body>
</html>
<?php
include('includes/footer.php');
?>



