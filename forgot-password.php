<?php
 require_once "controllerUserData.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body  background="website logo/backg1.jpg">
     <center> 
       <h1 style="margin-top:90px; ;">𝓞𝓵𝓭 𝓢𝓬𝓻𝓸𝓵𝓵</h1>
       <h2 style="margin-top:-15px; ;">𝓡𝓮𝓪𝓭 𝓜𝓸𝓻𝓮, 𝓢𝓹𝓮𝓷𝓭 𝓛𝓮𝓼𝓼.</h2>&nbsp;
     </center>
    <div class="container" >
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forgot-password.php" method="POST" autocomplete="" onsubmit="return form(Form)">
                <script src="javascript files/forms.js"></script>
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your Email Address</p>
                    <?php
                        if(count($errors) > 0)
                        {
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error)
                                    {
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div> 
</body>
</html>
