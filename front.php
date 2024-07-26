<?php
include('include/login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>front</title>
   <style>
* {
   /* font-family: "Lato", sans-serif; */
   font-family:'Poppins', sans-serif;
   margin: 0;
   padding: 0;
   outline: none;
   border: none;
   text-decoration: none;

}

body {
   background-color: #fff;
}

.container {
   padding: 20px;
   margin: 0 auto;
   max-width: 1200px;
   display: flex;
   flex-direction: row;
   align-items: center;
   justify-content: center;
   border-radius:10px;
   box-shadow: 0 5px 10px #ccc;
   background-color: #fff;
}

/* making two columns in the container  */
.column {
   flex:1;
   padding: 40px;
   padding-top: 0px;
}

.h2-column {
   flex-direction:column;
   text-align: center;
   justify-content: center;
}

.h2-column h1 {
   color: #318216;
   font-size: 70px;
   font-weight: bold;
   text-align: left;
   justify-content: center;
}

.h2-column p {
   font-size: 24px;
   text-align: left;
   justify-content: center;
   color: black;
}

.form-container {
         min-height: 85vh; 
         padding:20px;
         display: flex;
         align-items:center;
         justify-content: center;
        
      }
      form {
         width: 220px;
         padding: 50px; 
         background-color:#fff;
         border-radius: 10px;
         box-shadow: 2px 4px 6px 2px #ccc;
         text-align: center;
         /* color:white; */
      }

      h3 {
         font-size: 24px;
         margin-bottom: 20px;
         margin-top: 10px;
         text-transform: uppercase;
         color:#333; 
      } 

      input[type="email"],
      input[type="password"],
      input[type="submit"] 
      {
         display: block;
         width: 94%;
         padding: 12px 14px;
         margin: 12px auto;
         font-size: 18px;
         border-radius: 10px;  
         border: 2px solid #ccc;
      }

      input[type="submit"] {
         padding: 12px 8px;
         display: flex;
         justify-content: center;
         align-items: center;
         width: 40%;
         max-width: 200px;
         margin: 20px auto 0;
         /* background-color: #3498db; */
         background-color: #3e838e;
         border:none;
         color: white;
         cursor: pointer;
      }

      input[type="submit"]:hover {
         background-color: #333;
      }

      p {
         margin-top: 20px;
         font-size: 15 px;
         color: black;
      }

      p a {
         color:crimson;
      }
            
      .message {
      position: sticky;
      top: 0;
      left: 0;
      right: 0;
      padding: 15px 10px;
      background-color: #fff;
      box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.1);
      color: #333;
      font-size: 20px;
      /* text-transform: capitalize; */
      cursor: pointer;
      z-index: 1000;
      text-align: center;
}

      </style>

</head>
<body>
   <div class="form-container"> 
      <section class="home-section" id="home">
         <div class="container"> 
            <div class="column h2-column">
               <h1 style="font-family:sans-serif; color:black;">uthaoo</h1>
               <!-- <div class="logo">
                <a href="front.php"><img src="images/logo/uthaoo333.png"alt="Logo" style="width:170px;height:auto;text-align: left;
   justify-content: center;"></a>
            </div> -->
               <p>Turn your unwanted items into cash.</p><br>
            </div>
            <div class="column form-column">
               <?php
                  if(isset($message)){
                     echo '<div class="message">'.$message.'</div>';
                  }
               ?>

            <div class="form-container">
            <form action="" method="post">
               <h3 style="color:black;" >Login Now</h3>
               <input type="email" name="email" required placeholder="Enter Email" >
               <input type="password" name="password" required placeholder="Enter Password">
               <input type="submit" name="login" value="Login">
               <p>Not yet member? <a href="signup.php">Register</a></p>
            </form>
               </div>
            </div>
         </div>
      </section> 
   </div>
</body>
</html>

