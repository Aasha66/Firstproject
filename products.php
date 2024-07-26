<?php
//include('include/connection.php');
include('include/userprofile.php');
$conn = mysqli_connect('localhost','root','ankit','scrap') or die('connection failed');
// Debugging code
// var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone_no'];
  $address = $_POST['address'];
  $scrapItems = $_POST['scrap_items'];
  $description = $_POST['des'];
  $rate = $_POST['rate'];
  $quantity = $_POST['quantity'];

  // Process the uploaded files, if any
  $images = array();
  if (!empty($_FILES['images'])) {
    $files = $_FILES['images'];

    foreach ($files['tmp_name'] as $key => $tmp_name) {
      $filename = $files['name'][$key];
      $filetmp = $tmp_name;
      $destination = "C:/xampp/htdocs/EcoScrap/uploads/" . $filename;

      if (move_uploaded_file($filetmp, $destination)) {
        $images[] = $filename;
      }
    }
  }

  // Convert the images array to a comma-separated string
  $image = implode(", ", $images);

  // Insert the form data into the database
  $stmt = $conn->prepare("INSERT INTO sell (name, email, phone_no, address, scrap_items, `des`, rate, quantity, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssdss", $name, $email, $phone, $address, $scrapItems, $description, $rate, $quantity, $image);

  if (mysqli_stmt_execute($stmt)) {
    $successMessage = "Form submitted successfully!";
    echo '<script>alert("Your sell product form submitted successfully!");</script>';
  } else {
    $errorMessage = "Error submitting form: " . mysqli_stmt_error($stmt);
  }

  // Close the prepared statement
  $stmt->close();
}
?>

</html> 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Scrap request form</title>
 
  <style>
  * {
  box-sizing: border-box;
}

body {
  background-color: #f2f2f2;
  font-family: "Lato", sans-serif;
}

.container {
  background-color: white;
  border-radius: 10px;
  padding: 20px;
  width: 60%;
  margin: 0 auto;
  margin-top: 50px;
  box-shadow: 2px 0px 10px #888888;
}

h1 {
  color: #318216;
  margin-bottom: 20px;
  font-size: 24px;
  font-weight: 700;
  text-align: center;
}

label {
  /* font-weight: bold; */
}

input[type="text"],
input[type="number"],
select {

  width: 100%;
  height: 50px;
  padding: 12px;
  font-size:18px;
  border: 1px solid #0c0c0c;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

.form-row {
  display: flex;
  gap: 22px;
}

.form-row div {
  flex: 1;
}

textarea {
  width: 100%;
  height: 100px;
  padding: 12px;
  border: 1px solid #0c0c0c;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

.image-upload {
  display:inline-block;
    position: relative;
    width: 150px;
    height: 150px;
    background-color: #f1f1f1;
    border: 2px dashed #ccc;
    overflow: hidden;
  }

  .image-upload img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .image-upload input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
  }
  .image-preview {
    max-width: 100%;
    max-height: 100%;
  }

  .preview-container {
  position: relative;
  width: 200px;
  height: 200px;
  background-color: #f5f5f5;
  border: 2px dashed #ccc;
  display: flex;
  align-items: center;
  justify-content: center;
}

.upload-icon {
  font-size: 95px;
  color: #888;
}

input[type="submit"] {
  display: block;
  margin: 20px auto 0;
  font: 18px sans-serif;
  padding: 10px 20px;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #47474b;
}

  </style>
</head>


<body>
    <?php include('include/navbar.php'); ?>
    <div class="container">
  <h1 style="color:#318216;margin-bottom: 20px; font-size: 30px; font-weight: 700; text-align: center;">Scrap Request Form</h1>
  <form method="post" action="products.php" enctype="multipart/form-data">
    Name: 
    <input type="text" id="name" name="name" placeholder="Your name.." value="<?php echo isset($name) ? $name : ''; ?>" readonly><br>
    <div class="form-row">
        <div>
            Phone Number:
             <input type="text" id="phone_no" name="phone_no" placeholder="Your phone number.." pattern="[0-9]{10}" value="<?php echo isset($phone_no) ? $phone_no : ''; ?>" readonly>
        </div>
        <div>
            Email: <input type="text" id="email" name="email" placeholder="Your email .." value="<?php echo isset($email) ? $email : ''; ?>" readonly>
        </div>
    </div>
  Pick up Location: 
    <input type="text" id="address" name="address" required placeholder="Address"><br>
    Scrap Items:
    <!-- <select id="scrap-items" name="scrap_items" onchange="updateRate()" required> -->
    <select id="scrap-items" name="scrap_items" onchange="updateRate()" required>

    
        <option value="">-- Select Scrap Items --</option>
        <option value="Plastic" data-rate="10">Plastic</option>
        <option value="water Bottles" data-rate="5">Water Bottles(pcs)</option>
        <option value="Plastic" data-rate="0.1">Plastic</option>
        <option value="Newspapers" data-rate="3.5">Newspapers</option>
        <option value="Copies/Books" data-rate="1.8">Copies/Books</option>
        <option value="Cartoons" data-rate="0.5">Cartons</option>
        <option value="Battery" data-rate="0.1">Battery</option>
        <option value="Ewaste" data-rate="2.5">Ewaste</option>
        <option value="Mixed" data-rate="3.5">Mixed</option>
    </select><br>
    Rate (Rs/kg or per pcs): <input type="number" id="rate" name="rate" required readonly><br>
    Quantity (kg): <input type="number" id="quantity" name="quantity" required placeholder="Quantity in kg" onchange="calculateTotalAmount()"><br>
    <!-- Total Amount (Rs): <input type="text" id="total-amount" name="total-amount" readonly><br> -->
    Describe Your Product:<br>
    <textarea id="product-description" name="des" rows="4" placeholder="describe the scrap you have" required></textarea>
      Upload Images: <br>
      <div class="image-upload">
  <div id="image-preview-1" class="image-preview"></div>
  <input type="file" id="image-upload-input-1" name="images[]"  accept=".jpg, .jpeg, .png"multiple onchange="previewImages(event, 'image-preview-1')">
</div>
<div class="image-upload">
  <div id="image-preview-2" class="image-preview"></div>
  <input type="file" id="image-upload-input-2" name="images[]"  accept=".jpg, .jpeg, .png"  multiple onchange="previewImages(event, 'image-preview-2')">
</div>

    <input type="submit" value="Submit">
</form> 
</div>
<script src="js/scriptvalidation.js"> </script>  

<?php 
   include('include/footer.php'); ?>
</body>
</html>
