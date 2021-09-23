<?php
include('connection.php');
require_once __DIR__ . '/vendor/autoload.php';
$image=$_GET['idz'];
$mpdf = new \Mpdf\Mpdf();
$str=$image;
$str1="";
for($i=0;$i<4;$i++)
{
    if(is_numeric($str[$i]))
    {
        $str1.=$str[$i];
    }
}
$dir = 'files/';
if (is_dir($dir)){
    if ($dh = opendir($dir)){
       while (($file = readdir($dh)) !== false){
         if (is_file($dir.$file)) {
            if($file != '' && $file != '.' && $file != '..'){            
             echo $file;
             $mpdf = new \Mpdf\Mpdf();
             $mpdf->WriteHtml($file);
             $mpdf->Output($file,'D');
            }
           
         }else{
            // If directory
            if(is_dir($dir.$file) ){

              if($file != '' && $file != '.' && $file != '..'){

                // Add empty directory
                $zip->addEmptyDir($dir.$file);

                $folder = $dir.$file.'/';
 
                // Read data of the folder
                createZip($zip,$folder);
              }
            }
 
         }
 
       }
       closedir($dh);
     }
  }

?>