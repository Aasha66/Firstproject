
<?php
// include('include/navbar.php');
include('include/userprofile.php');
include('include/editprofile.php')?>
<html>
<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <style>
        .profile, 
        .update{
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .update{
            display: none;
        }
        .profile img,
        .update img {
            display: block;
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
        }

        .profile h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .profile p {
            color: #666;
            margin-bottom: 5px;
        }

        .profile p:last-child {
            margin-bottom: 0;

        }
        input[type="text"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 16px;
}

input[type="text"]:focus {
  outline: none;
  border-color: #2196F3;
}
    </style>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script>
        $(document).ready(function() {
            // Show update form when "Edit Profile" is clicked
            $(".edit-link").click(function() {
                $(".profile").hide();
                $(".update").show();
            });
        });
    </script>
</head>
<body>
<?php 
include('include/navbar.php'); ?>
<div class="profile">
    <?php
    if ($image) {
        $imagePath = "uploads/" . $image;
        $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        if (in_array($imageExtension, ['png', 'jpg', 'jpeg'])) {
            echo '<img src="' . $imagePath . '" alt="User Image" style="background-color: teal;">';
        } else {
            echo '<img src="default-image.png" alt="User Image" style="background-color: teal;">';
        }
    } else {
        echo '<img src="default-image.png" alt="User Image" style="background-color: teal;">';
    }
    ?>
    <h1 style="color: black;"><strong>Name:</strong> <?php echo $row["name"]; ?></h1>
    <p style="color: black;"><strong>Email:</strong> <?php echo $row["email"]; ?></p>
    <p style="color: black;"><strong>Phone Number:</strong> <?php echo $row["phone_no"]; ?></p>
    <br>
    <hr>
    <a href="#" class="edit-link">Edit Profile</a>
</div>
<!--update html part  -->
<div class="update"> <h2>Edit Profile</h2>
        <form method="POST" action="">
            Image:<input type="file" name="image" value="<?php echo $row['image']; ?>" required><br>
            Name:<input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
            Email:<input type="text" name="email" value="<?php echo $row['email']; ?>" required><br>
            Phone Number:<input type="text" name="phone_no" value="<?php echo $row['phone_no']; ?>" required>
            <br><br>

          <hr>
<br>    
            <!-- Add input field for image upload if needed -->
            <input type="submit" value="Update Profile" style="background-colr:red; ">  
        </form>
</div>
</body>
</html>
