<?php   

define('CSS_PATH', 'css/');
define('IMG_PATH', 'imgs/');
define('QR_PATH', 'qrcodes/');
     
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

 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tag Page</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>tag.css">
</head>
<body>
    <div class="tag-container">
         <div class="top-tag-container">
            <h3>KMA conference meeting</h3>
         </div>
         <div class="middle-tag-container">
            <div class="middle-info">
                <h4>22nd May, 2023</h4>
                <h5>Kenya Maritime Authority HQ</h5>
            </div>
            <div class="middle-logo">
                <img src="<?php echo IMG_PATH; ?>logoseal.png" width="45" >
            </div>
            <div class="middle-logo-info">
                <h1>IMO</h1>
            </div>
            <h1>AAMA</h1>
         </div>
         <div class="bottom-tag-container">
            <div class="image-profile-photo">
                <img src='<?php echo isset($user['image']) ? $user['Image'] : ''; ?>' width="150">
            </div>
            <div class="column-bottom">
                <div class="topQR">
                    <img src="<?php echo QR_PATH; ?>005_file_00ad9b76c8cc3bacc365a185069a2abc.png" width="70" >
                </div>
                <div class="user-info">
                    <h3><?php echo isset($user['name']) ? $user['name'] : ''; ?></h3>
                    <h4>KMA Meeting</h4>
                    <h5>Kenya Maritime Authority</h5>
                </div>
            </div>
         </div>
    </div>

    <button onclick="window.print()">Print</button>
</body>
</html>