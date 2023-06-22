<?php

define('CSS_PATH', 'css/'); 


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

//qr code lib
include('./phpqrcode/qrlib.php');


    //retrieve information from form and save in variable

    if(isset($_POST['apply_speaker'])){
        $name = $_POST['fullname'];
        $passport = $_POST['passport'];
        $country = $_POST['country'];
        $position = $_POST['position'];
        $topic = $_POST['topic'];
        $email = $_POST['email'];
    
     
     //create variables for connection

     $servername = 'localhost';
     $username = 'root';
     $password = '';
     $database = 'meeting_db';

    //create connection

     $conn = mysqli_connect($servername, $username, $password, $database);

     //test connection

     if(!$conn){
        die ("Connection to server error".mysqli_connect_error());
     }
     else{

        //enter data into database table using sql query
        
        $sql = "INSERT INTO speaker_tb (name, id_number, Country, Position, topic, Email ) VALUES ('$name', '$passport', '$country', '$position', '$topic', '$email')";
     }

     //if connection established and sql insert data function finished

     if (mysqli_query($conn, $sql)) {?>
        <script>alert("Meeting registration for speaker was a success. An email will be sent to you");
        </script>;
        <script> window.location = "done.php";</script>
        <?php
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      
      
      mysqli_close($conn);

      // how to save PNG codes to server


$tempDir = 'qrcodes/';
$meetingId = '001';
$meetingName = 'KMA meeting';

$codeContents = "Hello $name, Meeting ID: $meetingId";

// we need to generate filename somehow, 
// with md5 or with database ID used to obtains $codeContents...
$fileName = '005_file_'.md5($codeContents).'.png';

$pngAbsoluteFilePath = $tempDir.$fileName;
$urlRelativeFilePath = $tempDir.$fileName;

// generating
if (!file_exists($pngAbsoluteFilePath)) {
    QRcode::png($codeContents, $pngAbsoluteFilePath);
    echo 'File generated!';
    echo '<hr />';
} else {
    echo 'File already generated! We can use this cached file to speed up site on common codes!';
    echo '<hr />';
}

echo 'Server PNG File: '.$pngAbsoluteFilePath;
echo '<hr />';

// displaying
//echo '<img src="'.$urlRelativeFilePath.'" />';


//send email

//Create an instance; passing `true` enables exceptions

$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mr.spongebob404@gmail.com';                     //SMTP username
    $mail->Password   = 'aboqiugkcuhjbvvx';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mr.spongebob404@gmail.com', 'Albert, Admin');
    $mail->addAddress('albertdigara@gmail.com', 'Albert Oigara');     //Add a recipient
    $mail->addAddress($email);               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment($urlRelativeFilePath);         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Speaker Meeting Application';                                  //Set email format to HTML
    $mail->Body = '<p>Hello ' . $name . ',</p>
                   <p>Congratulations! Your KMA SPEAKER meeting application was successful.</p>
                   <p>Meeting ID: ' . $meetingId . '</p>
                   <p>Please find your unique QR code attached below:</p>
                   <img src="'.$urlRelativeFilePath.'" />';
    $mail->AltBody = 'The dates for the meeting will be sent to you in advance. Thank you';

        //Generate and attach the PDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
        $pdf->AddPage();
        //logo
        //$pdf->Image($urlRelativeFilePath,15,15,30,'','PNG');
        // set default header data
        $pdf->SetFont('helvetica', 'B', 14); 
        $pdf->Cell(0, 10, 'Speaker Information:', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 12); 
        $pdf->Ln(5);

        $pdf->SetLineWidth(0.5);
        $pdf->Line(15,60,195,60);

        $pdf->SetFont('helvetica', 'B', 14); 
        $pdf->Cell(0, 10, 'Speaker Meeting Details:', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Ln(5);

        //delegate qrcode
        $pdf->Image($urlRelativeFilePath,15,15,30,'','PNG');

        $pdf->SetFont('helvetica', 'B', 14);

        $pdf->Cell(0, 10, 'Meeting ID: ' . $meetingId, 0, 1, 'C');
        $pdf->Cell(0, 10, 'Meeting Name: ' . $meetingName, 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->Cell(0, 10, 'Name: ' . $name, 0, 1, 'L');
        $pdf->Cell(0, 10, 'Email: ' . $email, 0, 1, 'L');
        $pdf->Cell(0, 10, 'ID Number: ' . $passport, 0, 1, 'L');
        
        $pdfFilePath = (__DIR__ .'/pdfs/speaker_information.pdf');
        $pdf->Output($pdfFilePath, 'F');
        $mail->addAttachment($pdfFilePath, 'Speaker Information.pdf');



    $mail->send();
    echo 'Email Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


    }
 
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> KMA Meeting attendance</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>style.css">
</head>

<body>
    <div class="main-header">
            <div class="heading-title">
                <h3> KMA Meeting Attendance</h3>
            </div>
        
        <div class="badges">
           <div class="badge">
                <span class="bg-green"></span>
                <a href="index.php">
                    <div>
                            <h3>Delegate</h3>
                    </div>
                </a>
            </div>
    
            <div class="badge">
                <span class="bg-red"></span>
                <a href="vip.php">
                    <div>
                            <h3>VIP</h3>
                    </div>
                </a>
            </div>
    
            <div class="badge">
                <span class="bg-yellow"></span>
                <a href="support.php">
                    <div>
                            <h3>Support</h3>
                    </div>
                </a>
            </div>
    
            <div class="badge">
                <span class="bg-purple"></span>
                <a href="speaker.php">
                    <div>
                            <h3>Speaker</h3>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="header">
            <h3> KMA Meeting Attendance Speaker form </h3>
        </div>

        <form method = "post" action = "speaker.php" id="contact-form">

            <label> Name </label>
            <input type="text" class="input-form" name="fullname" required>
            <label> Passport/ID </label>
            <input type="number" class="input-form" name="passport" required>
            <label> Email </label>
            <input type="email" class="input-form" name="email" required>
            <label> Country</label>
            <select class="input-form" name = "country" required>
                <option>---Select---</option>
                <option value="Kenya">Kenya</option>
                <option value="Somalia">Somalia</option>
                <option value="Uganda">Uganda</option>
                <option value="Tanzania">Tanzania</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Sudan">Sudan</option>
            </select>
            <label> Position </label>
            <input type="text" class="input-form" name="position"required>
            <label> Topic </label>
            <textarea class="input-form" name="topic" required></textarea>

            <input type="submit" class="input-btn bg-purple" name="apply_speaker">

        </form>

    </div>

    <footer>
        <div class="main-footer">
            <h4>
                KMA secretariets contacts
            </h4>
            <h5>
                P.O BOX 95076-80104, Mombasa
            </h5>
            <h5>
                Email: info@kma.go.ke
            </h5>
        </div>
    </footer>
    <script src="/javascript.js"></script>
</body>

</html>