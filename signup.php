<?php
include('include/connection.php');

if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone_no = $_POST["phone_no"];

    // Check if the user already exists
    $select = mysqli_query($conn, "SELECT * FROM user_tbl WHERE email = '$email'");

    if (mysqli_num_rows($select) > 0) {
        echo 'User already exists!';
    } else {
        // Upload the image file
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $target = "uploads/" . basename($image);

        // Debug statements
        echo "Image Name: " . $image . "<br>";
        echo "Image Temp Name: " . $image_tmp . "<br>";
        echo "Target Path: " . $target . "<br>";
        echo "Image Name: " . $image . "<br>";
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($image_tmp, $target)) {
            $sql = "INSERT INTO user_tbl (name, email, password, phone_no, image, role) 
                    VALUES ('$name', '$email', '$password', '$phone_no', '$image', 'user')";

            $insert = mysqli_query($conn, $sql);

            if ($insert) {
                echo 'Registered successfully!';
                header('Location: front.php');
                exit;
            } else {
                echo 'Registration failed!';
            }
        } else {
            echo 'Image upload failed!';
        }
    }
}
?>

<!-- php ends -->
<!DOCTYPE html>
<html lang="en">
<head>

   <title>Register</title>
   <style>
      body {
         margin: 0;
         padding: 0;
         font-family: 'Poppins', "Lato", sans-serif;
      }

      .form-container {
        position: relative;
        width: 290px;
        display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         margin: 50px auto;
         background-color: #fff;
         padding: 20px;
         border-radius: 10px;
         box-shadow: 4px 0px 10px #ccc;
        
      }

      h3 {
         margin: 0 0 20px 0;
         text-align: center;
         text-transform: uppercase;
      }

      p {
         margin-top: 20px;
         /* font-size: 1px; */
         color: black;
         text-align: center;

      }
      p a{
   color:crimson;
   text-decoration:none;
      }
      .box {
         display: block;
         width: 100%;
         padding: 10px;
         margin-bottom: 20px;
         border: 1px solid #ccc;
         border-radius: 5px;
         box-sizing: border-box;
         font-size: 16px;
      }

      .btn {
         display: block;
         margin: 0 auto;
         width: 50%;
         /* align-items: center; */
         padding: 10px;
         margin-top: 20px;
         background-color: #3e838e;
         color: #fff;
         border: none;
         border-radius: 10px;
         font-size: 16px;
         cursor: pointer;
      }

      .btn:hover {
         background-color:  #47474b;
      }
      .error {
      color: red;
      font-size: 15px;
      padding-top:2px;
      /* text-align: top; */
      /* padding: 10px; */
    }
      .message {
         display: block;
         width: 80%;
         padding: 10px;
         margin-bottom: 20px;
         background-color: #f44336;
         color: #fff;
         text-align: center;
         font-size: 16px;
         cursor: pointer;
      }

      /* Radio button styling */
      label {
         display: inline-block;
         margin-right: 10px;
      }

      input[type="radio"] {
         display: inline-block;
         margin-right: 5px;
      }

      cicrle
   </style>
</head>

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<body>
   <?php  
   // include('include/navbar.php');

if (isset($message)) {
   foreach ($message as $msg) {
      echo '<div class="message" onclick="this.remove();">' . $msg . '</div>';
   }
}

?>
<div class="form-container">

<i class='bx bx-x'onclick="goToLoginPage()"
style="color:#FF0000;font-size:22px; top:10px;right:10px;position:absolute;cursor: pointer;"></i>

  <form action="" method="post">
    <h3 style="color:green;">Register Now</h3>

    <input type="file" name="image" id="image" class="box">

    <input type="text" name="name" id="name" required placeholder="Enter full name" class="box">
    <span class="error" id="name-message"></span>

    <input type="text" name="email" id="email"  required placeholder="Enter email" class="box">
    <span class="error" id="email-message"></span>

    <input type="password" name="password" id= "password" required placeholder="Enter password" class="box">
    <span class="error" id="password-message"></span>

    <input type="tel" name="phone_no" id="phone_no" required placeholder="Enter phone number" class="box">
    <span class="error" id="phone-message"></span>

   <input type="submit" name="submit" class="btn" value="Register now">
<br>
    <p>Already have an account? <a href="front.php">Login now</a></p>
  </form>
</div>
<script>
  function goToLoginPage() {
    window.location.href = "front.php";
  }
</script>
<script src="scriptvalidation.js"> </script>


</body>
</html>
