<?php require_once "controllerUserData.php"; ?>
<?php
if($_SESSION['info'] == false){
    header('Location: login-user.php');  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body background="website logo/backg1.jpg">
<center> 
       <h1 style="margin-top:90px; ;">𝓞𝓵𝓭 𝓢𝓬𝓻𝓸𝓵𝓵</h1>
       <h2 style="margin-top:-15px; ;">𝓡𝓮𝓪𝓭 𝓜𝓸𝓻𝓮, 𝓢𝓹𝓮𝓷𝓭 𝓛𝓮𝓼𝓼.</h2>&nbsp;
     </center>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
            <?php 
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>
                <form action="login-user.php" method="POST" id="Form"  onsubmit="return form(Form)">
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login-now" value="Login Now">
                    </div>
                    <script src="javascript files/forms.js"></script>
                </form>
            </div>
        </div>
    </div>
    <?php
    mysqli_close($con);
    ?>
</body>
</html>