<?php

require('fpdf/fpdf.php');

     //create variables for connection

     $servername = 'localhost';
     $username = 'root';
     $password = '';
     $database = 'meeting_db';

    //create connection

     $conn = mysqli_connect($servername, $username, $password, $database);

     //test connection...

     if(!$conn){
        die ("Connection to server error".mysqli_connect_error());
     }

     else{
        
        //select data from database table using sql query...
        
       if(isset($_GET['id'])){
        $id = $_GET['id'];


            // Set the table names based on your requirements
            $tables = array('delegate_tb', 'vip_tb', 'support_tb', 'speaker_tb');

            // Search for the user in each table
            $user = null;
            foreach ($tables as $table) {
                $sql = "SELECT * FROM $table WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);
                    break;
                }
            }


       }

     } 


 header('Content-type: image/jpeg');
 $font=realpath('GreatVibes-Regular.ttf');
 $image=imagecreatefromjpeg("cert.jpg");
 $color=imagecolorallocate($image, 51, 51, 102);
 $date=date('d F, Y');
 imagettftext($image, 18, 0, 325, 640, $color,$font, $date);
 $name="Albert Bonty";
 imagettftext($image, 48, 0, 420, 360, $color,$font, $name);
 imagejpeg($image,"certs_photos/$name.jpg");
 //imagejpeg($image);
 imagedestroy($image);  

$pdf = new FPDF('L', 'pt', array(1040, 720));
$pdf->AddPage();
// Set the image position to cover the entire page
$pdf->Image("certs_photos/$name.jpg", 0, 0, 1040, 720);
ob_end_clean();
$pdf->Output();


?>