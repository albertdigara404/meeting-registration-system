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
        
        $sqlDelegate = "SELECT * FROM delegate_tb ";
        $delegateQuery = mysqli_query($conn, $sqlDelegate);
        $delegateRows = mysqli_fetch_all($delegateQuery, MYSQLI_ASSOC);
        $delegateCount = count($delegateRows);

        $sqlVIP = "SELECT * FROM vip_tb";
        $vipQuery = mysqli_query($conn, $sqlVIP);
        $vipRows = mysqli_fetch_all($vipQuery, MYSQLI_ASSOC);
        $vipCount = count($vipRows);

        $sqlSpeaker = "SELECT * FROM speaker_tb";
        $speakerQuery = mysqli_query($conn, $sqlSpeaker);
        $speakerRows = mysqli_fetch_all($speakerQuery, MYSQLI_ASSOC);
        $speakerCount = count($speakerRows);

        $sqlSupport = "SELECT * FROM support_tb";
        $supportQuery = mysqli_query($conn, $sqlSupport);
        $supportRows = mysqli_fetch_all($supportQuery, MYSQLI_ASSOC);
        $supportCount = count($supportRows);


        $allMembers = array_merge($delegateRows, $vipRows, $speakerRows, $supportRows);
        $totalMembersCount = count($allMembers);

        $displayAll = false;

        // if(isset($_GET['id'])){
        //     $id = $_GET['id'];
        //    }

        if(isset($_GET['expand']) && $_GET['expand']=='true'){
            $displayAll = true;
        }

        if(!$displayAll){
            $allMembers = array_slice($allMembers, 0, 10);
        }

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
        <a href="#" class="active">
            <i class="uil uil-create-dashboard"></i>
            <h3>Dashboard</h3>
            <span><?php echo $totalMembersCount; ?></span>
        </a>
        <a href="meetings.php">
            <i class="uil uil-meeting-board"></i>            
            <h3>Meetings</h3>
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
        <h2>Welcome</h2>

        <div class="info">
                <div class="info-header">
                    <i class="uil uil-users-alt"></i>
                    <h3>Total Members</h3>
                </div>
                <div class="middle">
                    <h1><?php echo $totalMembersCount; ?></h1>
                </div>
            </div>

        <div class="cards">

            <div class="card">
                <div class="top-header">
                    <i class="uil uil-user"></i>            
                    <h3>Delegates</h3>
                </div>
                <div class="middle">
                    <h1><?php echo $delegateCount; ?></h1>
                </div>
            </div>

            <div class="card">
                <div class="top-header">
                    <i class="uil uil-user-check"></i>            
                    <h3>Speaker</h3>
                </div>
                <div class="middle">
                    <h1><?php echo $speakerCount; ?></h1>
                </div>
            </div>

            <div class="card">
                <div class="top-header">
                    <i class="uil uil-chat-bubble-user"></i>           
                    <h3>Support</h3>
                </div>
                <div class="middle">
                    <h1><?php echo $supportCount; ?></h1>
                </div>
            </div>

            <div class="card">
                <div class="top-header">
                    <i class="uil uil-user-square"></i>            
                    <h3>VIP</h3>
                </div>
                <div class="middle">
                    <h1><?php echo $vipCount; ?></h1>
                </div>
            </div>
        </div>

        <h2>All Applicants</h2>

        <div class="middle-section">

        <div class="table-wrapper">
            <table id="members-table">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>ID No.</th>
                    <th>Country</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($allMembers as $index => $members): ?>

                <tr <?php if($index >=10 && !$displayAll) echo 'class="hidden"'; ?>>
                    <td><?php echo $members['name']; ?></td>
                    <td><?php echo $members['Email']; ?></td>
                    <td><?php echo $members['id_number']; ?></td>
                    <td><?php echo $members['Country']; ?></td>
                    <td><?php echo $members['Position']; ?></td>
                    <td>
                        <a href="create_member_tag.php?id=<?php echo $members['id']; ?>">  <i class="uil uil-ellipsis-h"></i>
                          

                        <!-- <div class="action-dropdown">
                            
                            <div class="dropdown-menu">
                                <div class="dropdown-option">Print User Info</div>
                                <div class="dropdown-option">Create User Tag</div>
                            </div>
                        </div> -->
                    </td>
                </tr>

                <?php endforeach; ?>

            </table>
        </div>

        <?php if(!$displayAll): ?>
       <a href="?expand=true" id="expand-btn" >Show All</a>
       <?php endif; ?>

        </div>
    </section>

    <div class="right">

        <div class="download-container">
            <h2>Download Table</h2>
                <button id = "download-btn" onClick= "downloadTable();">Click here</button>
        </div>

        <div class="filter-container">
            <h2>Filter table</h2>
            <form class="filter-form" action = "print.php" method = "post">
                <input type="checkbox" name = "columns[]" value = "name" checked>Name<br>
                <input type="checkbox" name = "columns[]" value = "Email" checked>Email<br>
                <input type="checkbox" name = "columns[]" value = "id_number" checked>ID No.<br>
                <input type="checkbox" name = "columns[]" value = "Country" checked>Country<br>
                <input type="checkbox" name = "columns[]" value = "Position" checked>Position<br>

                <input type="submit" value="Print">
        </form>
        </div>

    </div>

   </main>

   <script>
        function downloadTable(){
            var table = document.getElementById('members-table');
            var html = table.outerHTML.replace(/ /g, '%20');
            var downloadLink = document.createElement('a');
            downloadLink.href = 'data:application/vnd.ms-excel,'+html;
            downloadLink.download = 'members_table.xls';
            downloadLink.click();

            $('.dropdown-toggle').click(function(){
                var dropdownMenu = $(this).siblings('.dropdown-menu');
                dropdownMenu.toggle();
            });

            // $('.dropdown-option').
        }
   </script>
</body>

</html>