<?php   

define('CSS_PATH', 'css/');
     
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

     } 

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>styles.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <nav>
        <div class="logo">
            <img src="/logo.png">
            <div class="menu">
                <i class="uil uil-bars"></i>
            </div>
        </div>
        <div class="profile">
            <div class="profile-img">
                <img src="/profile.png">
            </div>
            <i class="uil uil-angle-down"></i>
        </div>
    </nav>
    

   <main>
    <aside>
        <div class="top">
            <div class="top-left">
                <i class="uil uil-dashboard"></i>
            <h4><span>KMA</span> Admin Dashboard</h4>
            </div>

            <div class="close-btn">
                <i class="uil uil-times-circle"></i>
            </div>
        </div>

      <div class="side-menu">
        <a href="admin.php" >
            <i class="uil uil-create-dashboard"></i>
            <h3>Dashboard</h3>
        </a>
        <a href="#" class="active">
            <i class="uil uil-meeting-board"></i>            
            <h3>Meetings</h3>
        </a>
        <a href="#">
            <i class="uil uil-user"></i>            
            <h3>Delegates</h3>
        </a>
        <a href="#">
            <i class="uil uil-user-check"></i>            
            <h3>Speaker</h3>
        </a>
        <a href="#">
            <i class="uil uil-chat-bubble-user"></i>            
            <h3>Support</h3>
        </a>
        <a href="#">
            <i class="uil uil-user-square"></i>            
            <h3>VIP</h3>
        </a>
      </div>

      <div class="report">
        <h3>LogOut of Admin</h3>
        <div class="logout-btn">
            <a href="#">Logout</a>
        </div>
      </div>
    </aside>

    <section class="middle">
        <div class="meeting-container">
            <header>Create Meeting</header>

            <form >
                <div class="form first">
                    <div class="personal details">
                        <span>Enter the details below</span>
                        <div class="fields">
                            <div class="input-fields">
                                <Label>Meeting ID</Label>
                                <input type="text" name="meetingID" placeholder="Meeting ID">
                            </div>
                            <div class="input-fields">
                                <Label>Meeting ID</Label>
                                <input type="text" name="meetingID" placeholder="Meeting ID">
                            </div>
                            <div class="input-fields">
                                <Label>Meeting ID</Label>
                                <input type="text" name="meetingID" placeholder="Meeting ID">
                            </div>
                            <div class="input-fields">
                                <Label>Meeting ID</Label>
                                <input type="text" name="meetingID" placeholder="Meeting ID">
                            </div>
                            <div class="input-fields">
                                <Label>Meeting ID</Label>
                                <input type="text" name="meetingID" placeholder="Meeting ID">
                            </div>
                            <div class="input-fields">
                                <Label>Meeting ID</Label>
                                <input type="text" name="meetingID" placeholder="Meeting ID">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        
    </section>

    <div class="right">

        <div class="filter-container">
            
        </div>

    </div>

   </main>

</body>

</html>