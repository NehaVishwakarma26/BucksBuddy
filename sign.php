<?php
session_start();

$success = 0;
$user = 0;
$invalid = 0;

$terms_accepted = 2; // Variable to track if terms are accepted

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'connect.php';

  $username = $_POST['name'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $cpassword = $_POST['cpassword'];

  // Check if terms are accepted
  if (isset($_POST['accept_terms'])) {
    $terms_accepted = true;
    $cbox = 1;
  } else {
    // If terms are not accepted, set an error flag
    $terms_accepted = false;
    $cbox = 0;
  }


  if ($terms_accepted) {

    $sql = "SELECT * FROM `registration` WHERE email='$email'";


    $result = mysqli_query($con, $sql);

    if ($result) {
      $num = mysqli_num_rows($result);
      if ($num > 0) {
        // echo"User already exist";
        $user = 1;
      } else {
        if ($password === $cpassword) {
          $hash = password_hash($password, PASSWORD_DEFAULT);

          $sql = "INSERT INTO `registration` (username, email, password ) VALUES ('$username', '$email', '$hash')";
          $result = mysqli_query($con, $sql);
          if ($result) {
            // echo "Signup Successful";
            $success = 1;
          }
        } else {
          $invalid = 1;
        }
      }
    }
  }
}
?>

<?php
if ($success) {
  ob_start(); // Start output buffering


  //     echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert" style="border-radius: 0;">
  // <strong>Success!</strong> You are Successfully Signed Up.
  // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close";></button>
  // </div>';


  $_SESSION['email'] = $email;
  $_SESSION['username'] = $username;
  $base_url = "http://localhost/mpr/";
  $redirect_url = $base_url . "login.php";
  header("Location: $redirect_url");
  exit();
}
ob_end_flush();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Signup Form</title>
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



  <div class="topnav">
    <img src="logo_s.jpg" alt="Logo">
    <a href="home.php">Home</a>
    <a href="about.php">About</a>

  </div>
  <!-- Alert note start-->



  <?php
  if (!$terms_accepted) {

    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert" style="border-radius: 0;">
<strong>Sorry!</strong> please accept the terms & conditions.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }


  ?>

  <?php
  if ($user) {

    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert" style="border-radius: 0;">
<strong>Sorry!</strong> User Already Exist.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>

  <?php
  if ($invalid) {

    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert" style="border-radius: 0;">
<strong>Sorry!</strong> Password Dont match.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }


  ?>




  <!-- Alert note End-->

  <div class="body">
    <section class="wrapper">
      <div class="form signup">
        <header> Signup</header>
        <form method="post" action="sign.php">
          <input type="text" name="name" placeholder="First name" required />
          <input type="text" name="email" placeholder="Email address" required />
          <input type="password" name="password" placeholder="Password" required />
          <input type="password" name="cpassword" placeholder="Confirm Password" required />

          <p class="additional_info">Have an account? <a href="login.php"> &nbsp;Log in</a></p>

          <div class="checkbox">
            <input type="checkbox" id="signupCheck" name="accept_terms" />
            <label class="terms_n_c" for="signupCheck">I accept all <a href="">terms & conditions</a></label>

          </div>
          <input type="submit" value="Signup" />
        </form>
      </div>
    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>