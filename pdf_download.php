<?php
include('connection.php');
require_once __DIR__ . '/vendor/autoload.php';
$pdf_book=$_GET['nm'];
$sql="SELECT book_pdf from books where book_pdf='$pdf_book'";
$query=mysqli_query($con,$sql);
while($result=mysqli_fetch_array($query))
{
    $res=$result['book_pdf'];
}
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHtml($pdf_book);
 $mpdf->Output($pdf_book.='.pdf','D');
?>