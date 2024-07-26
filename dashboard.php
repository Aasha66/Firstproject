<?php
// include('include/navbar.php');
include('include/userprofile.php');
include('include/editprofile.php')?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style/userdash.css">
</head>

<body>
    <div class="dashboard">
        <!-- side bar -->
    <div class="sidebar"> <a href="#"><img src="images/logo/uthaoo4b.png" alt="Logo"></a>
    <ul>
        <li><a href="#" class="home">Home</a></li>
        <!-- <li><a href="profile.php">Profile</a></li> -->
        <!-- <li><a href="#">Sell Scrap</a></li> -->
        <li><a href="#">Show Requests</a></li>
        <li><a href="#">Show Feedbacks</a></li>
        
        <!-- <li><a href="home.php">Go Back</a></li> -->
        <li><a href="front.php">Logout</a></li>
        
    </ul>
</div>

        <!-- Main Body -->
        <div class="main-content">
            <div class="header">
                <h2>Welcome to User Panel,<span style=" background: green; color:#fff;border-radius: 8px;"><?php echo $row["name"]; ?> </span></h2>  
                <a href="adminpage.php" style="text-align: right; display: flex; color:red;">Go Back</a>


            </div>  

            <!-- Body -->
            <div class="body">
    <div class="data-info">
        <div class="total-sold">
            <h2>Total sold(kg)</h2>
            <h1>0</h1>
        </div>
        <div class="total-requests">
            <h2>Total Requests</h2>
            <h1>0</h1>
        </div>
        <div class="total-accepted">
            <h2>Total Accepted</h2>
            <h1>0</h1>
        </div>
        <div class="pending-requests">
            <h2>Pending Requests</h2>
            <h1>0</h1>
        </div>
    </div>
</div>

        </div>
    </div>
</body>

</html>
