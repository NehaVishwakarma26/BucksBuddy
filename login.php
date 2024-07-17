<?php
session_start();

$login = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'connect.php';

  $password = $_POST['password'];
  $email = $_POST['email'];

  $sql = "SELECT * FROM `registration` WHERE email='$email'";
  $result = mysqli_query($con, $sql);

  if ($result) {
    $num = mysqli_num_rows($result);

    if ($num > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
          $login = 1;
          $id = $row['id'];
          
          $username = $row['username'];
          $_SESSION['email'] = $email;
$_SESSION['id']=$id;
          $_SESSION['username'] = $username;
          // echo $username;
          // echo $email;
          // echo $id;
          // Fetch username associated with the logged-in user
          // $sql1 = "SELECT * FROM userinfo WHERE userid='$id'";
          // $res = mysqli_query($con, $sql1);

          // if ($result) {
          //   $num1 = mysqli_num_rows($res);
          //   if ($num1 > 0) {

          //   }
          // }

          // Redirect to savinggoals.php after successful login
    


          $sql1 = "SELECT * FROM userinfo WHERE userid='$id'";
          $result1 = mysqli_query($con, $sql1);
          if ($result1) {
              $row1 = mysqli_fetch_assoc($result1);
              if($row1)
              {
                $category = $row1['category'];
                $income=$row1['income'];
                $_SESSION['income']=$income;
                switch ($category) {
                    case 'student':
                        header("Location: s_dashboard.php");
                        exit();
                        break;
                    case 'working':
                        header("Location: w_dashboard.php");
                        exit();
                        break;
                    case 'non-working':
                        header("Location: nw_dashboard.php");
                        exit();
                        break;
                    default:
                        // Handle default case if needed
                        break;
                }
              }

              else{
                header("Location: selectcategory.php");
                }
           
          }
        
          







          // $sql2 = "SELECT * FROM `student` WHERE userid='$username'";
          // $result2 = mysqli_query($con, $sql2);
          // if ($result2) {
          //   $num2 = mysqli_num_rows($result2);
          //   if ($num2 > 0) {
          //     header("Location: s_dashboard.php");
          //     exit();
          //   }
          // }
          
          // $sql3 = "SELECT * FROM `working` WHERE username='$username'";
          // $result3 = mysqli_query($con, $sql3);
          // if ($result3) {
          //   $num3 = mysqli_num_rows($result3);
          //   if ($num3 > 0) {
          //     header("Location: w_dashboard.php");
          //     exit();
          //   }
          // }
          
          // $sql4 = "SELECT * FROM `nonworking` WHERE username='$username'";
          // $result4 = mysqli_query($con, $sql4);
          // if ($result4) {
          //   $num4 = mysqli_num_rows($result4);
          //   if ($num4 > 0) {
          //     header("Location: nw_dashboard.php");
          //     exit();
          //   }
          // }
          

          //  header("Location: selectcategory.php");
          // Ensure script execution stops after redirection
        }
      }
    } else {
      $invalid = 1;
    }
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>
  <!-- css link -->
  <link rel="stylesheet" href="styles.css" />
  <!--bootstrap css link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

    * {
      margin: 0;

      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins",
        sans-serif;
    }

    .body {

      min-height: 100vh;
      display: flex;
      align-items: top;
      padding-top: 18px;
      justify-content: center;
      /* background:#1f2029; */
      /* background: #313638; */
      background-color: rgb(0, 0, 0);

    }

    .logo {
      display: flex;
      align-items: top;
    }


    .wrapper {
      height: 600px;
      position: relative;
      /* max-width: 370px; */
      max-width: 470px;
      width: 100%;
      border-radius: 12px;
      padding: 30px 30px 120px;
      /* background: #445d5c; */
      background: #545F66;
      /* signup background */
      box-shadow: 0 5px 10px rgba(0,
          0,
          0,
          0.1);
      overflow: hidden;
    }

    #login {
      max-height: 70vh;
      width: 60vh;
    }

    #login.wrapper {
      margin-top: -100;

    }

    .form header {
      font-size: 30px;
      text-align: center;
      color: #ffff00;
      /* color:#ffeba7; */
      /* sign up color */
      font-weight: 600;
      cursor: pointer;
    }



    .wrapper form {
      display: flex;
      flex-direction: column;
      gap: 20px;
      margin-top: 40px;
    }

    form input {
      height: 60px;
      outline: none;
      border: none;
      padding: 0 15px;
      font-size: 16px;
      font-weight: 400;
      color: #ffffff;
      border-radius: 8px;
      background: #1f2029;

    }



    form .checkbox {
      display: flex;
      align-items: center;
      gap: 10px;
      /* color: #ffeba7; */
      color: #ffff00;
    }

    .checkbox input[type="checkbox"] {
      height: 16px;
      width: 16px;
      /* accent-color: #ffeba7; */
      accent-color: #ffff00;
      cursor: pointer;
    }

    form .checkbox label {
      cursor: pointer;
      /* color: #ffeba7; */
      color: #ffff00;

    }


    form a {
      /* color: #ffeba7; */
      color: #ffff00;
      text-decoration: none;
    }

    form a:hover {
      text-decoration: underline;
      /* color:#ffeba7; */
      color: #ffff00;
    }

    /* Signup button */
    form input[type="submit"] {

      margin-top: -2px;
      padding: none;
      font-size: 18px;
      font-weight: 500;
      cursor: pointer;
      color: black;
      /* background-color: #ffeba7; */
      background-color: #ffff00;
    }


    /*  */

    .topnav {
      padding: 16px 5px;
      padding-left: 20px;
      overflow: hidden;
      background-color: black;
      /* margin-bottom: 0; Add this line to remove the bottom margin */
    }


    .topnav a {

      float: right;
      color: #f2f2f2;
      text-align: center;
      padding: 1px 16px;
      text-decoration: none;
      font-size: 17px;
    }

    .topnav a:hover {
      font-size: 22px;
      color: yellow;
      /* background-color: #ddd; */
      color: yellow;
    }


    /* Have an account? Log in */
    .additional_info {
      margin-top: -14px;
      margin-bottom: 8px;

    }

    .login_additional_info {
      margin-top: -7px;
      margin-bottom: 1px;

    }

    .terms_n_c a:hover {
      color: rgb(0, 227, 72);
    }
  </style>

  <?php

  ?>

  <div class="topnav">
    <img src="logo_s.jpg" alt="Logo">
    <a href="home.php">Home</a>
    <a href="about.php">About</a>
  
  </div>


  <!-- Alert note start-->
  <?php
  if ($invalid) {


    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert" style="border-radius: 0;">
<strong>Error!</strong> Invalid credentials.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>



  <!-- Alert note End-->


  <div class="body">
    <section class="wrapper" id="login">
      <div class="form login">
        <header>Login</header>
        <form action="login.php" method="post">
          <input type="text" placeholder="Email address" name="email" required />
          <input type="password" placeholder="Password" name="password" required />
          <a href="#">Forgot password?</a>

          <p class="login_additional_info">Don't have an account?<a href="sign.php"> &nbsp; Sign up</a></p>
          <input type="submit" value="Login" />
        </form>
      </div>
    </section>
  </div>
</body>

</html>