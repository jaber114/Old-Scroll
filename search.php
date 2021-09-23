
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search page</title>
    <link rel="stylesheet" href="css files/prod_search.css">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</head>
<body>
<?php
include('includes/navbar.php');
require('includes/login_info.php');
require('connection.php');
$current_user=$fetch_info['name'];
$current_email=$fetch_info['email'];
if(!$con)
{
    echo "failed to connect to database";
}
    $res=$_POST['search'];
    if($res)
    {
        $row="SELECT * FROM books WHERE book_name='$res'";  
        $result=mysqli_query($con,$row);
        if(mysqli_num_rows($result) > 0)
        {
            while($rows=mysqli_fetch_array($result))
            {
                $cat=$rows["book_cat"];
               echo "<div class='container-fluid' style=margin:right;>";
               echo   '<div class="card mx-auto col-md-3 col-10 mt-5"> <img class="mx-auto img-thumbnail" src="books_images/'.$rows['book_cat'].'/'. $rows["book_image"].'"width="auto" height="auto"/>';
               echo   '<div class="card-body text-center mx-auto">';
               echo  "<div class='cvp'>";
               echo    '<h4 class="card-title font-weight-bold">';
               echo $rows['book_name'];
               echo '</h4>';
               echo    '<h4 class="card-title font-weight-bold">';
               echo $rows["book_price"].='₪';
              echo '</h4>';
               echo '<a " style="color:white; background-color:orange; heigth: 50px; width:100px;" href="book_detail.php?book_id='. $rows['book_isbn'].'" ">view details</a>';
              echo "<br /> ";
               echo   "</div>";
               echo   "</div>";
               echo  "</div>";
               echo "</div>";
            }
            $user_query="SELECT * FROM usertable where name='$current_user'";
            $q=mysqli_query($con,$user_query);
            while($results=mysqli_fetch_array($q))
            {
               if($results["group_joining"]=="yes")
               {
                    $sql="INSERT INTO search_results(book_name,user_name,user_email) VALUES
                ('$res','$current_user','$current_email')
                ";
                $query=mysqli_query($con,$sql);
               }
            }
            $query9="SELECT * from usertable";
            $define=mysqli_query($con,$query9);
            while($loop=mysqli_fetch_array($define))
            {
                $em=$loop['email'];
                $nm=$loop['name'];
             
                if($loop['group_joining']=="yes")
                {

               
                $loop1="UPDATE search_results SET user_email ='".$em."' WHERE user_name='".$nm."' and user_email<>'".$current_email."'
                and user_name<>'".$current_user."'";
                $final=mysqli_query($con,$loop1);
                }
            }
            include('match_search.php');
        }
        else
        {
            echo '<center>';
            echo "<h1>nothing found like this</h1>";
            echo $res;
            echo '</center>';
        }
    }
    else
    {
        echo '<center>';
        echo '<h1>';
        echo "write something to search";
        echo '</h1>';
        echo '</center>';
    }
?>  
</body>
</html>
<?php
include('includes/footer.php'); 
?>
