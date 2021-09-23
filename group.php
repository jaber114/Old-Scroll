<?php
error_reporting(0);
ini_set('display_errors', 0);
include('connection.php');
require('includes/login_info.php');
include('includes/navbar.php');
$current_user=$fetch_info['name'];
$current_email=$_SESSION['email'];
$arr=array();
$i=0;
$arr1=array();
$j=0;
$check="SELECT * FROM usertable Where email='$current_email'";
$sql1=mysqli_query($con,$check);
while($row1=mysqli_fetch_array($sql1))
{
    if($row1['group_joining']=="yes")
    {
        $temp="SELECT * FROM search_results Where user_name='$current_user'";
        $sql2=mysqli_query($con,$temp);
        while($row2=mysqli_fetch_array($sql2))
        {
             $arr1[$j++]=$row2['book_name'];
        }
    }
}
$select="SELECT book_name,Count(book_name) from search_results group by book_name having count(book_name)>1";
$sql3=mysqli_query($con,$select);
while($row3=mysqli_fetch_array($sql3))
{
   $book=$row3['book_name'];
   $sql6="SELECT * FROM search_results where book_name='$book'";
   $coz=mysqli_query($con,$sql6);
   while($rows=mysqli_fetch_array($coz))
   {
      if($rows['book_name']==$book)
      { 
          $arr1[$j++]=$rows['book_name'];
      }
   }
}
$arr2=array();
$len=count($arr1)-1;
$k=0;
for($i=0;$i<$len;$i++)
{
  if($arr1[$i]!=$arr1[$i+1])
  {
    $arr2[$k++]=$arr1[$i];
  }
}
$arr2[$k++]=$arr1[count($arr1)-1];
for($i=0;$i<$k;$i++)
{
  $arr1[$i]=$arr2[$i];
}
$arr3=array();
$arr3=array_unique($arr2);
function diffrent($book)
{
    include('connection.php');
    $count=0;
    $sql66="SELECT book_cat from books where book_name='$book'";
    $qr12=mysqli_query($con,$sql66);
    while($resz=mysqli_fetch_array($qr12))
    {
        $r=$resz['book_cat'];
        echo '<script>alert("'.$resz['book_cat'].'"</script>';
    }
    $dif="SELECT book_name,book_cat FROM books where book_name<>'$book' and book_cat='$r' order by RAND()";
    $qr=mysqli_query($con,$dif);
    while($result=mysqli_fetch_array($qr))
    {

        $tem=$result['book_name'];
        return $tem;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading Group</title>
</head>
<body>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<div class="container">
    <center>
    <div class="row header" style="margin-left:300px;color:orange">  
        <h1>Reading Group of: &nbsp;<?php echo $current_user;?></h1>   
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Matched Book</th>
                <th>Matched With</th>
                <th>Recomended Book 1</th>
                <th>Recomended Book 2</th>
                <th>Recomended Book 3</th>
                <th>Contact Mail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $temp=0;
                for($i=0;$i<count($arr3)-1;$i++)
                {
                        $temp=$arr3[$i];
                    $quere10="SELECT * from search_results where book_name='$temp' and user_name<>'$current_user'";
                    $my=mysqli_query($con,$quere10);
                    while($diffrent=mysqli_fetch_array($my))
                    {
                    $book=$arr3[$i];
        ?>
                <td><?php echo $diffrent['book_name'];?></td>
                <td><?php echo $diffrent['user_name'];?></td>
                <td><?php echo diffrent($diffrent['book_name']);?></td>
                <td><?php echo diffrent($diffrent['book_name']);?></td>
                <td><?php echo diffrent($diffrent['book_name']);?></td>
                <td><?php echo $diffrent['user_email']; ?></td>  
            </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
</div>   
</body>
</html>
<?php 
include('includes/footer.php');
mysqli_close($con);
?>
