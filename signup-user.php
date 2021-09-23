
<?php
 require_once "controllerUserData.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css files/rate.css">
</head>
<body background="website logo/backg1.jpg">
    <div class="container" style="margin-left:-380px;">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="signup-user.php" method="POST" id="Form"  onsubmit="return form(Form)" autocomplete="">
                    <h2 class="text-center">Signup Form</h2>
                    <p class="text-center">It's quick and easy.</p>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                        <script src="javascript files/forms.js"></script>
                    <div class="form-group">

                        <input class="form-control" type="text" name="name" placeholder="Full Name" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm password" required>
                    </div>
                    <div class="form-group">
                    <h4>interested to join reading group?</h4>
                    <div class="row">
                    <div class="form-check mb-4">
                    <input name="answer"  type="radio" value="yes" />
                    <label for="Very good" class="ml-3" style="font-size:14px; margin-top:-15px;">yes</label>
                    </div>
                    <div class="form-check mb-4">
                    <input name="answer"  type="radio" value="no" />
                    <label for="Good" class="ml-3" style="font-size:14px; margin-top:-15px;">no</label>
                    </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="button" value="reading group info" onclick="myFunction()">
                        
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Signup">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="login-user.php">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
   <center> 
       <h1 style="margin-top:90px; margin-right:-160px;">𝓞𝓵𝓭 𝓢𝓬𝓻𝓸𝓵𝓵</h1>
       <h2 style="margin-top:90px; margin-right:-160px;">𝓡𝓮𝓪𝓭 𝓜𝓸𝓻𝓮, 𝓢𝓹𝓮𝓷𝓭 𝓛𝓮𝓼𝓼.</h2>&nbsp;
     </center>
     <script>
function myFunction() {
var text="reading group contains users that accept to"
 +" joining it and have the same search results,the reading group connect between two users or more that have the same search results, by adding them to a table and recommended to them books that they didnt read
 ";
alert("hi");
}
</script>
</body>
</html>
<?php
mysqli_close($con);
?>