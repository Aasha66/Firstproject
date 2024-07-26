<?php
include("include/userprofile.php");
$conn = mysqli_connect('localhost', 'root', 'ankit', 'scrap') or die('Connection failed');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone_no = $_POST['phone_no'];
  $message = $_POST['message'];
  $errorMessage = '';

  if (empty($message)) {
    $errorMessage = "Please write something!";
  } else {
    $stmt = mysqli_prepare($conn, "INSERT INTO `feedback` (`name`, `email`, `phone_no`, `message`) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
      die("Error preparing statement: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone_no, $message);

    if (mysqli_stmt_execute($stmt)) {
      $successMessage = "Form submitted successfully!";
      echo '<script>console.log("Feedback form submitted successfully!");</script>';
    } else {
      $errorMessage = "Error submitting form: ". mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
  }
}
?>  
<!-- php script ends here -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Give your feedback</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #f2f2f2;
    }

    .container {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      width: 30%;
      margin: 0 auto;
      margin-top: 50px;
      box-shadow: 0px 0px 10px #888888;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    input[type=text], textarea {
      width: 100%;
      padding: 12px;
      font: 15px sans-serif;
      border: 1px solid #0c0c0c;
      border-radius: 4px;
      box-sizing: border-box;
      margin-top: 6px;
      margin-bottom: 16px;
    }

    input[type=submit] {
      display: block;
      margin: 0 auto;
      background-color: green;
      color: white;
      font-size: 15px;
      padding: 12px 20px;
      border: none;
      font-weight: 400;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type=submit]:hover {
      background-color: #333;
      
    }

    .error {
  border-color: red;
  border-width: 2px;
}

    .error-indicator::after {
    content: "*";
    color: red;
    margin-left: 5px;
  }
  </style>
</head>

<body>
  <?php include('include/navbar.php'); ?>
  
  <div class="container">
  <h1 style="color: green;">Have Your Say</h1>
  <form action="" method="POST">
    <input type="text" name="name" placeholder="Your name.." value="<?php echo isset($name) ? $name : ''; ?>" readonly>
    <input type="text" name="email" placeholder="Your email.." value="<?php echo isset($email) ? $email : ''; ?>" readonly>
    <input type="text" name="phone_no" placeholder="Your phone number.." pattern="[0-9]{10}" value="<?php echo isset($phone_no) ? $phone_no : ''; ?>" readonly>
    <textarea name="message" placeholder="Write something.." style="height: 90px;" class="<?php echo !empty($errorMessage) ? 'error-indicator' : ''; ?>"></textarea>
    <?php if (!empty($errorMessage)) : ?>
      <p class="error"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <input type="submit" name="submit" value="Send Message">
  </form>
  <?php if (!empty($successMessage)) : ?>
    <script>
      alert("<?php echo $successMessage; ?>");
    </script>
  <?php endif; ?>
</div>



  <script>
    // Helper function to check if a string is empty
    const isEmpty = (str) => str.trim().length === 0;

    // Select the submit button and message textarea elements
    const submit = document.querySelector('input[type="submit"]');
    const message = document.querySelector('textarea[name="message"]');

    // Add click event listener to the submit button
    submit.addEventListener("click", (e) => {
      // Check if the trimmed length of the message textarea value is 0
      if (isEmpty(message.value)) {
        // If message is empty, prevent form submission and display error message
        e.preventDefault();
        message.classList.add("error"); // Add CSS class to highlight the input as error
      } else {
        // If message is not empty, remove error class
        message.classList.remove("error");
      }
    });
  </script>
  <?php include('include/footer.php'); ?>
</body>
</html>
