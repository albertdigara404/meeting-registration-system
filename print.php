<?php

$servername = 'localhost';
     $username = 'root';
     $password = '';
     $database = 'meeting_db';

    //create connection

     $conn = mysqli_connect($servername, $username, $password, $database);

     //test connection...

     if(!$conn){
        die ("Connection to server error".mysqli_connect_error());
     }else{


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected columns from the form
    $selectedColumns = isset($_POST['columns']) ? $_POST['columns'] : array();

    // Assuming you have already established a database connection

    // Fetch data from delegate table
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

    // Combine all rows into a single array
    $allMembers = array_merge($delegateRows, $vipRows, $speakerRows, $supportRows);

}
    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Print User Data</title>
    <style>
        body{
            background: #eaeaea;
            padding: 30px;
        }

        table{
            margin-top: 20px;
            margin-bottom: 20px;
            width: 100%;
            background: #fff;
            padding: 20px;
            text-align: center;
            border-collapse: collapse;
        }

        th,td{
            height: 2.8rem; 
            border: 1px solid #000;
        }

    </style>

</head>
<body>
    <h2>KMA Members Meeting Attendance Data</h2>
    <table>
        <tr>
            <?php foreach ($selectedColumns as $column): ?>
                <th><?php echo ucfirst($column); ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($allMembers as $member): ?>
            <tr>
                <?php foreach ($selectedColumns as $column): ?>
                    <td><?php echo $member[$column]; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <button onclick="window.print()">Print</button>
</body>
</html>

<?php
}
?>
