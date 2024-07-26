<?php
// userprofilealready includeed in the feedback.php.. userdash1 is not real...........userdash2 is  real
include('./include/feedback.php');  
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="userdash/feedbackdash.css">
    <link rel="stylesheet" href="style/userdash.css">
</head>

<body>
        <!-- side bar -->
        <div class="dashboard">
        <!-- side bar -->
        <div class="sidebar">
            <a href="userdashw.php"><img src="images/logo/uthaoo4b.png" alt="Logo"></a>
            <ul>
                <li><a href="#" class="home active" id="homeContentLink" onclick="showContent('homeContent')">Home</a></li>
                <li><a href="#" onclick="showContent('profileContent')">Profile</a></li>
                <li><a href="#" onclick="showContent('sellScrapForm')">Sell Scrap</a></li>
                <li><a href="#">Show Requests</a></li>
                <li><a href="#" onclick="showContent('feedbackForm')">Feedback</a></li>
                <li><a href="#" onclick="showContent('changePasswordContent')">Change Password</a></li>
                <li><a href="/front.php">Logout</a></li> 
            </ul>
        </div>

        <!-- Main Body -->
        <div class="main-content">
<div class="header" style="position: relative;">
    <!-- <a href="#userdash2.php" style="display: inline-block; position: absolute; left:0px;" ><img src="images/logo/uthaoo4b.png" alt="Logo"></a> -->
    <h2 style="display: inline-block; margin-right: 10px; text-align:center;">Hi,<span style="background: black; color:#fff;border-radius: 2px;"><?php echo $row["name"]; ?> </span>.<t> Welcome to User Panel!!</h2>
    <a href="home.php" style="display: inline-block; position: absolute; right: 5px;color:#fff ; padding: 5px 8px; background-color: #8888; border-radius: 5px; text-decoration: none;">Go to home</a>
</div>
<div id="homeContent">
                <div class="data-info">
                    <div class="total-sold">
                        <h2>Total sold (kg)</h2>
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
                    <!-- Table to display data -->
                    <table>
                        <th>
                            <tr>
                                <th>SN</th>
                                <th>Location</th>
                                <th>Scrap Items</th>
                                <th>Rate</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </th>
                        <tbody>
                            <!-- PHP code to fetch data from the database and generate table rows dynamically -->
                            <?php
                                $sql = "SELECT * FROM feedback";
                                $result = mysqli_query($connection, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['SN'] . "</td>";
                                    echo "<td>" . $row['location'] . "</td>";
                                    echo "<td>" . $row['scrap_items'] . "</td>";
                                    echo "<td>" . $row['rate'] . "</td>";
                                    echo "<td>" . $row['quantity'] . "</td>";
                                    echo "<td><button onclick='deleteRow(this)'>Delete</button></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="sellScrapForm" style="display: none;">
                <!-- Sell Scrap Form Content -->
            </div>

            <div id="profileContent" style="display: none;">
                <!-- Profile Content -->
            </div>

            <div id="changePasswordContent" style="display: none;">
                <!-- Change Password Content -->
            </div>

            <div class="container" id="feedbackForm" style="display: none;">
                <h1 style="color:green;">Have Your Words</h1>
                <form action="" method="POST">
                    <input type="text" id="name" name="name" placeholder="Your name.." value="<?php echo isset($name) ? $name : ''; ?>" readonly>  
                    <div id="name-message" class="error-message"></div>
                    <input type="text" id="email" name="email" placeholder="Your email.." value="<?php echo isset($email) ? $email : ''; ?>" readonly>
                    <div id="email-message" class="error-message"></div>
                    <input type="text" id="phone_no" name="phone_no" placeholder="Your phone number.." pattern="[0-9]{10}" value="<?php echo isset($phone_no) ? $phone_no : ''; ?> "readonly>
                    <div id="phone-message" class="error-message"></div>
                    <textarea id="message" name="message" placeholder="Write something.." style="height: 90px;"><?php echo isset($message) ? $message : ''; ?></textarea>
                    <div id="message-message" class="error-message"></div>
                    <input type="submit" name="submit" value="Send Message">
                </form>
            </div>

            <script>
                // scriptfile for handling the delete button in table
    function deleteRow(button) {
        var row = button.parentNode.parentNode;
        row.remove();
    }
</script>

            <script>
    function showContent(contentId) {
        var content = document.getElementById(contentId);
        content.style.display = "block";

        var sidebarLinks = document.querySelectorAll(".sidebar a");
        sidebarLinks.forEach(function(link) {
            link.classList.remove("active");
        });

        var activeLink = document.getElementById(contentId + "Link");
        activeLink.classList.add("active");

        var contentSections = document.querySelectorAll(".data-content > div");
        contentSections.forEach(function(section) {
            if (section.id !== contentId) {
                section.style.display = "none";
            }
        });

        // Clear input field values and error messages
        var inputFields = content.querySelectorAll("input[type=text], textarea");
        inputFields.forEach(function(field) {
            field.value = '';
        });

        var errorMessages = content.querySelectorAll(".error-message");
        errorMessages.forEach(function(message) {
            message.innerHTML = '';
        });
    }
</script>
        </div>
    </div>
</body>
</html>
