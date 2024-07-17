<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Start session and include database connection
session_start();
include("connect.php");

$email=$_SESSION["email"] ;
$username = $_SESSION["username"] ?? null;
$data = [];
$not1='';
$message='';
$completed='';
$goalname='';
$message2='';
$save=0;
$update_saved=0;
$current_saved=0;
$to = $email;
$fro="nehavishwakarma2607@gmail.com";
$headers="From: $fro";
$subject = "Goal Completed";

$email_message = "xyz";

$name="BucksBuddy";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $goalname = $_POST['goalname'];
    $save = $_POST['save'];

    // $targetamount = $_POST['targetamount'];
    // $note = $_POST['note'];
    // $targetdate = $_POST['targetdate'];
    // Prepare the SQL statement with placeholders


    $sql = "SELECT * FROM `saving` WHERE goal_name='$goalname'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);

    if ($num > 0) {
    $row = mysqli_fetch_assoc($result);
    $targetdate = $row['target_date'];
    $targetamount = $row['target_amount'];
    $status = $row['status'];
    $current_saved = $row['saved'];
 

        if ($current_saved === 0) {
            $sql1 = "UPDATE saving SET saved = $save WHERE goal_name = '$goalname'";
            $result2 = mysqli_query($con, $sql1);
            if ($result2) {
                if ($targetamount <= $save) {
                    $sql2 = "UPDATE saving SET status = 'completed' WHERE goal_name = '$goalname'";
                    $completed=mysqli_query($con, $sql2);
                    $subject = $goalname." Completed";
                    $email_message="Goal completed";

                    mail($to,$subject,$email_message,$headers);
                    $current_saved=0;

    
// if(mail($to,$subject,$email_message,$headers))
// {
//     echo "Email sent";
// }else{
//     echo "failed";
// }


                    
                }
                // header("Location: " . $_SERVER['PHP_SELF']);
                // exit();
            }
        } else {
            $update_saved = $current_saved + $save;
            $sql1 = "UPDATE saving SET saved = $update_saved WHERE goal_name = '$goalname'";
            $result2 = mysqli_query($con, $sql1);
            if ($result2) {
                if ($targetamount <= $update_saved) {
                    $sql2 = "UPDATE saving SET status = 'completed' WHERE goal_name = '$goalname'";
                    $completed=mysqli_query($con, $sql2);
                    $subject = $goalname." Completed";
                    $email_message="Goal completed";

                    mail($to,$subject,$email_message,$headers);
                   $update_saved=0;

                }
                // header("Location: " . $_SERVER['PHP_SELF']);
                // exit();
            }
        }
    }

    else{
        $not1="This goal does not exists.";
    }

    if($completed)
    {
         $message="Congratulations! The goal $goalname is completed.";
    }


    // $sql = "INSERT INTO saving (username, goal_name, target_amount, target_date, note) VALUES (?, ?, ?, ?, ?)";
    // $stmt = $con->prepare($sql);
    // $stmt->bind_param("sssss", $username, $goalname, $targetamount, $targetdate, $note);

    // if ($stmt->execute()) {
    //     // Redirect to avoid form resubmission
    //     header("Location: " . $_SERVER['PHP_SELF']);
    //     exit(); // Stop further execution
    // } else {
    //     echo "Error: " . $sql . "<br>" . $stmt->error;
    // }
}

// Retrieve saving goals for the current user


$sql = "SELECT * FROM saving WHERE username = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$message = '';
foreach ($data as $goal) {
    $targetDate = strtotime($goal['target_date']);
    $currentDate = time();
    if ($currentDate > $targetDate) {
        $message .= "The target date for goal '{$goal['goal_name']}' has passed. Goal could not be completed.<br>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BucksBuddy</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="style_saving.css">


<style>
    .progress-done {
        display: flex;
        align-items: center;
        background-image: repeating-linear-gradient(to left, #0546e0, #1172f9, #4892f9);
        box-shadow: 0 5px -6px #0546e0, 0 3px 7px #1172f9;
        /* border-radius: 20px; */
        color: white;
        height: 100%;
        width: 0;
        transition: 1s ease 0.3s;
        font-weight: 100;
        flood-color: white;
    }

    .progress-value {

        position: absolute;
        top: -25px;
        left: 95%;
        transform: translateX(-50%);

        font-size: 16px;
    }

    .Tprogress-value {

        position: absolute;
        top: -25px;
        left: 5%;

        transform: translateX(-50%);
        font-size: 16px;

    }

    .num {
        display: flex;
        align-items: last baseline;
    }

    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;0,800;1,600&display=swap');


    /* nav */

    .nav {
        box-shadow: 0px 4px 25px rgba(57, 57, 62, 0.278);
        /* box-shadow: #181a1e; */
    }

    .topnav {
        padding: 16px 5px;
        padding-left: 20px;
        overflow: hidden;
        background-color: #181a1e;

    }

    .topnav a {

        float: right;
        color: #f2f2f2;
        text-align: center;
        padding: 20px 25px;
        /* padding for feature buttos  */
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        font-size: 22px;
        color: yellow;
        /* background-color: #ddd; */
        color: yellow;
    }

    p {
        background-color: transparent;
    }

    h2 {
        background-color: transparent;
    }

    a {
        text-decoration: none;
        color: #A979EF;
    }

    /* nav ends */

    /* variables */


    :root {

        --clr-color-background: #181a1e;
        --clr-white: #202528;
        --clr-light: rgba(0, 0, 0, 0.4);
        --clr-dark: #edeffd;
        --clr-dark-variant: #677483;
        --box-shadow: 0 2rem 3rem var(--clr-light) --clr-primary-variant: #111e88;
        --clr-primary: #7380ec;
        --clr-danger: #ff7782;
        --clr-success: #41f1b6;

        --clr-info-dark: #7d8da1;
        --clr-info-light: #dce1eb;
        --clr-warnig: #ff4edc;



        --card-border-radius: 2rem;
        --border-radius-1: 0.4rem;
        --border-radius-2: 0.8rem;
        --border-radius-3: 1.2rem;

        --card-padding: 1.8rem;
        --padding-1: 1.2rem;
        --box-shadow: 0 2rem 3rem var(--clr-light);

    }

    /* saving Goals form */
    .addsgoal {

        max-width: 100%;
        gap: 20px;
        align-items: flex-start;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0px 0px 22px var(--clr-light);
    }

    .addsgoal {
        font-size: 2.2rem;
        font-weight: 600;
        color: white;
    }

    /* saving goals form */
    .sub-title {
        font-size: 1rem;


    }

    .input-feild {

        width: 100%;
        outline: 0;
        /* color: var(--para-color); */
        color: black;
        border: 2px solid var(--clr-info-dark);
        /* background-color:var(--clr-info-light) ; */
        padding: 13px;
        border-radius: 8px;

    }

    #Targetdate {
        position: relative;
        top: -10px;
    }

    .input-feild:focus {
        border-color: #5854D8;
    }

    /* .addsgoal:hover {
  box-shadow: none;
}  */

    .primary-btn {

        text-align: center;
        padding-top: 10px;
        width: 100%;
        height: 45px;
        color: var(--clr-white);
        background-color: var(--clr-primary);
        border: 0;
        outline: 0;
        border-radius: 8px;
        font-size: 1.6rem;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        box-shadow: 0px 0px 18px -5px var(--main-color);
        transition: 0.7s ease;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .primary-btn:hover {
        background-color: var(--clr-success);
    }





    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        border: 0;
        text-decoration: none;
        list-style: none;
        appearance: none;
    }

    body {
        width: 100vw;
        height: 100vh;
        font-size: .7rem;
        user-select: none;
        overflow-x: hidden;
        background: var(--clr-color-background);
        font-family: 'Poppins', sans-serif;
    }

    .container {

        display: grid;
        width: 96%;
        gap: 2.8rem;
        grid-template-columns: 12rem auto 20rem;
        max-width: 1200px;
        /* Adjust the maximum width as needed */
        margin: 0 auto;
        /* Center the container */
    }

    a {
        color: var(--clr-dark);
    }

    h1 {
        font-weight: 800;
        font-size: 2.8rem;

    }

    h2 {
        /* padding-top: 100px; */
        font-size: 1.4rem;
        color: white;
    }

    h3 {
        padding-top: 5%;
        padding-left: 15%;
        font-size: 0.87;

    }

    h4 {
        font-weight: 0.8rem;
    }

    h5 {
        font-size: 0.77rem;
    }

    small {
        color: #FFF;
        font-size: 0.75rem;
    }

    .profile-photo img {
        width: 2.8rem;
        height: 2.8rem;
        overflow: hidden;
        border-radius: 50%;
    }

    .text-muted {
        color: var(--clr-info-dark);
    }

    p {
        color: var(--clr-dark-variant);
    }

    b {
        color: var(--clr-dark);
    }

    .primary {
        color: var(--clr-primary);
    }

    .success {
        color: var(--clr-success);
    }

    .danger {
        color: var(--clr-danger);
    }

    .warning {
        color: var(--clr-warnig);
    }


    /* aside */
    /* aside {
  height: 8vh;
} */

    /* aside .top{
  background: var(--clr-white);
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 1.4rem;
 }

 aside .logo{
   display: flex;
   gap: 1rem;
 }
 aside .logo img{
   width: 2rem;
   height: 2rem;
 }
 aside .top div.close span{
   display: none;
 } */

    /* ===================
 Sidebar
 ================== */

    /* aside .sidebar {
  background: var(--clr-white);
  display: flex;
  flex-direction: column;
  height: 86vh;
  position: relative;
  top: 1rem;
}

aside h3 {
  font-weight: 500;
}

aside .sidebar a {
  display: flex;
  color: var(--clr-info-dark);
  margin-left: 2rem;
  gap: 1rem;
  align-items: center;
  height: 3.3rem;
  transition: all .1s ease;

}

aside .sidebar a span {
  font-size: 1.6rem;
  transition: all .3s ease-in-out;

}

aside .sidebar a:last-child {
  position: absolute;
  bottom: 1rem;
  width: 100%;
}

aside .sidebar a.active {
  background-color: var(--clr-light);
  color: var(--clr-primary);
  margin-left: 0;
  border-left: 5px solid var(--clr-primary);
  margin-left: calc(1rem - 3px);
}

aside .sidebar a:hover span {
  margin-left: 1rem;
}

aside .sidebar a span.msg_count {
  background-color: var(--clr-danger);
  color: var(--clr-white);
  padding: 2px 5px;
  font-size: 11px;
  border-radius: var(--border-radius-1);
} */

    /* ----------------------------
 --------- Main--------------
 ------------------------------ */

    main {
        margin-top: 1.4rem;
        width: auto;
    }

    main input {
        background-color: transparent;
        border: 0;
        outline: 0;
        color: var(--clr-dark);
    }

    main .date {
        display: inline-block;
        background: var(--clr-white);
        border-radius: var(--border-radius-1);
        margin-top: 1rem;
        padding: 0.5rem 1.6rem;
    }

    main .insights {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1.6rem;
    }

    /* .plus-sign{             
                          
  position: relative;
  max-width: 50px;
  top: -80px;
  left: 90vh;

} */
    .plus-sign {
        /* plus sign */
        /* display: flex; */
        position: relative;
        max-width: 50px;
        top: -80px;
        left: 50vh;
    }

    .material-symbols-sharp:hover {
        background-color: #41f1b6;
        transition: 0.5s ease;


    }

    main .insights>div {
        background-color: var(--clr-white);
        padding: var(--card-padding);
        border-radius: var(--card-border-radius);
        margin-top: 1rem;
        box-shadow: var(--box-shadow);
        transition: all .3s ease;
    }

    main .insights>div:hover {
        box-shadow: none;
    }

    main .insights>div span {
        background: coral;
        padding: 0.5rem;
        border-radius: 50%;
        color: var(--clr-white);
        font-size: 2rem;

    }

    main .insights>div.expenses span {
        background: var(--clr-danger);

    }

    main .insights>div.income span {
        background: var(--clr-success);
    }

    main .insights>div .middle {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }


    main .insights>div .middle h1 {
        font-size: 1.6rem;
    }

    main h1 {
        color: var(--clr-dark);
    }

    main .insights h1 {
        color: var(--clr-dark);
    }

    main .insights h3 {
        color: var(--clr-dark);
    }

    main .insights p {
        color: var(--clr-dark);
    }

    main .insights h3 {

        color: var(--clr-dark);


    }



    main .insights .progress {
        /* progress bar */

        position: relative;
        height: 30px;
        width: 250px;
        border-radius: 5px;
        color: rgb(255, 255, 255);
    }

    .progress {
        background-color: gray;
        position: absolute;
    }





    main .insights .progress .number {
        position: absolute;
        top: 5%;
        left: 5%;
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* recent order */

    main .Your_Saving_Goals {
        margin-top: 2rem;
    }

    main .Your_Saving_Goals h2 {
        color: var(--clr-dark);
    }

    main .Your_Saving_Goals h2 {
        margin-bottom: 0.8rem;
    }

    main .Your_Saving_Goals table {
        background: var(--clr-white);
        width: 100%;
        border-radius: var(--card-border-radius);
        padding: var(--card-padding);
        text-align: center;
        box-shadow: var(--box-shadow);
        transition: all .3s ease;
        color: var(--clr-dark);
    }

    main .Your_Saving_Goals table:hover {
        box-shadow: none;
    }

    main table tbody td {
        height: 3.8rem;
        /* border-bottom: 1px solid var(--clr-white); */
        color: var(--clr-dark-variant)
    }

    /* main table tbody tr:last-child td{
   border: none;
} */


    main .Your_Saving_Goals a {
        text-align: center;
        display: block;
        margin: 1rem;
    }


    /*********************
Right Side
**********************/

    .right {
        margin-top: 1.4rem;
    }

    .right h2 {
        color: var(--clr-dark);
    }

    .right .top {
        display: flex;
        justify-content: start;
        gap: 2rem;
    }

    .right .top button {
        display: none;
    }

    .right .theme-toggler {
        background: var(--clr-white);
        display: flex;
        justify-content: space-between;
        height: 1.6rem;
        width: 4.2rem;
        cursor: pointer;
        border-radius: var(--border-radius-1);
    }

    .right .theme-toggler span {
        font-size: 1.2rem;
        width: 50%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .right .theme-toggler span.active {
        background: var(--clr-primary);
        color: #fff;
    }


    .right .top .profile {
        display: flex;
        gap: 2rem;
        text-align: right;
    }

    .right .info h3 {
        color: var(--clr-dark);
    }

    .right .item h3 {
        color: var(--clr-dark);
    }

    /* recent update */

    .right .enter_savinggoals {
        margin-top: 1rem;
        margin-left: -20px;
    }

    .right .enter_savinggoals .sgoals {
        background-color: var(--clr-white);
        padding: var(--card-padding);
        border-radius: var(--card-border-radius);
        box-shadow: var(--box-shadow);
        transition: all .3s ease;
    }

    .right .enter_savinggoals .sgoals:hover {
        box-shadow: none;
    }

    .right .enter_savinggoals .sgoal {
        display: grid;
        grid-template-columns: 2.6rem auto;
        gap: 1rem;
        margin-bottom: 1rem;
    }




    /* see analytics */

    .right .sales-analytics {
        margin-top: 2rem;
    }

    .right .sales-analytics h2 {
        margin-bottom: 0.8rem;
    }

    .right .sales-analytics .item {
        background-color: var(--clr-white);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin: 10px 0;
        width: 100%;
        margin-bottom: 0.8rem;
        padding: 1.4rem var(--card-padding);
        border-radius: var(--border-radius-3);
        box-shadow: var(--box-shadow);
    }

    .right .sales-analytics .item:hover {
        box-shadow: none;
    }

    .right .sales-analytics .item .icon {
        padding: 0.6rem;
        color: var(--clr-white);
        border-radius: 50%;
        height: 50px;
        width: 50px;
        line-height: 50px;
        align-items: center;
        background: coral;
    }

    .right .sales-analytics .item:nth-child(3) .icon {
        background: var(--clr-success);
    }

    .right .sales-analytics .item:nth-child(4) .icon {
        background: var(--clr-danger);
    }

    .right .sales-analytics .item .right {
        margin-left: 15px;
        display: flex;
        justify-content: space-around;
    }

    .right .sales-analytics .item .right h3 {
        color: var(d);
    }


    .add_product div {
        display: flex;
        height: 60px;
        width: 100%;
        text-align: center;
        justify-content: center;
        align-items: center;
        border: 2px dashed;
        color: var(--clr-dark-variant);
        margin-bottom: 40px;

    }


    #goalpng {

        max-width: 350px;
        position: relative;
        align-items: center;
        top: 25px;
        left: 50px;
    }

    /* **********8
MEDIA QUERY
****************/

    @media screen and (max-width:1200px) {
        .container {


            width: 94%;
            grid-template-columns: 7rem auto 14rem;
        }

        .plus-sign {
            /* plus sign */
            position: relative;
            max-width: 50px;
            top: -80px;
            left: 90vh;

        }

        main .insights {
            display: grid;
            margin-left: 0;
            grid-template-columns: repeat(1, 1fr);
        }
    }

    /* ****************
MEDIA QUERY PHONE
************************/

    @media screen and (max-width:768px) {
        .container {
            width: 100%;

            grid-template-columns: repeat(1, 1fr);

        }


        @keyframes menuLeft {
            to {
                left: 0;
            }
        }



        .right .top {
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 0.8rem;
            background: var(--clr-white);
            height: 4.6rem;
            width: 100%;
            z-index: 2;
            box-shadow: 0 1rem 1rem var(--clr-light);
            margin: 0;
        }


        main .insights {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.6rem;
            padding: 40px;
        }

        main .Your_Saving_Goals {
            padding: 30px;
            margin: 0 auto;
        }



        .right .profile {
            position: absolute;
            left: 70%;
        }

        .right .top .theme-toggler {
            width: 4.4rem;
            position: absolute;
            left: 50%;
        }

        .right .profile .info {
            display: none;
        }

        .right .top button {
            display: inline-block;
            background: transparent;
            cursor: pointer;
            color: var(--clr-dark);
            position: absolute;
            left: 1rem;

        }

        .right .Your_Saving_Goals {
            padding: 0 30px;
        }

        .right .enter_savinggoals {
            padding: 0 40px;
        }

        .right .sales-analytics {
            padding: 0 40px;
        }

        .right .add_product {
            padding: 0 40px;
            margin-bottom: 40px;
        }


    }


    .message{
        font-size: 30px;
        color: white;
    }
</style>


</head>


<body>
    <?php

    $base_url = "http://localhost/mpr/";
    ?>
    <div class="nav">
        <div class="topnav">
            <img src="<?php echo $base_url . "logo-recolored.png" ?>" alt="Logo">
            <a href="home.php">Home</a>
            <a href="savinggoals.php">Saving Goals</a>
            <a href="logout.php">Logout</a>
            <?php
            $email=$_SESSION['email'];
            $username=$_SESSION['username'];
            $id=$_SESSION['id'];
            $sql10="select * from `userinfo` where userid='$id'";
            $result10=mysqli_query($con,$sql10);
            $row10=mysqli_fetch_assoc($result10);
            
            $category=$row10['category'];
            $base_url = "http://localhost/mpr/";

if($category=="student")
{
$redirect="s_dashboard.php";
}
else if($category=="working")
{
$redirect="w_dashboard.php";
}
else if($category=="non-working")
{
$redirect="nw_dashboard.php";
}
            ?>
            <a href="<?php echo $base_url.$redirect ?>">Dashboard</a>
        </div>
    </div>
    <div class="container">


        <aside>
            <!-- This tag will change the style, dont remove them-->
        </aside>

        <!-- --------------
        end asid
      -------------------- -->


        <!-- --------------
        start main part
      --------------- -->
        <main>
            <div class="message"> <?php echo $not1; ?>  </div>
             <div class="message"> <?php echo $message; ?></div>
             <div class="message"> <?php echo $message2; ?></div>


            <h1>SET YOUR SAVING GOALS</h1>


            <div class="insights">
                <span class="img" id="goalpng">
                    <img src="<?php echo $base_url . "goal.png" ?>" id="goalpng" alt="">
                </span>

                <!-- New appended div -->


            </div>

            <div class="Your_Saving_Goals">
                <h2>Your Saving Goals</h2>
                <table id="myTable">

                    <tr>
                        <th>Goal Name</th>
                        <th>Target Amount</th>
                        <th>Target Date</th>
                        <!-- <th>Category</th> -->
                        <th>Saved</th>
                        <th>Status</th>
                    </tr>

                    </thead>
                    <tbody>
                        <?php
                        // Loop through the $data array to display each row as a table row
                        foreach ($data as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['goal_name'] . "</td>";
                            echo "<td>" . $row['target_amount'] . "</td>";
                            echo "<td>" . $row['target_date'] . "</td>";
                            echo "<td>" . $row['saved'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="#">Show All</a>
            </div>

        </main>

        <div class="right">

            <div class="top">


            </div>

            <!-- Saving goals Form -->


            <div class="enter_savinggoals">
                <h2>Check savings</h2>

                <div class="addsgoal flex fl-col">

                    <div class="sgoals-title">Savings</div>

                    <form action="checksaving.php" method="post" id="myForm" class="flex fl-col">

                        <h class="sub-title">Goal Name </h>
                        <input type="text" class="input-feild" id="name" name="goalname" placeholder="Saving goal name.." autofocus>

                        <!--<h class="sub-title">Category</h>
            <input type="text" class="input-feild" id="category" name="category" placeholder="Category.." autofocus> -->

                        <!-- <h class="sub-title">Target Amount </h>
                        <input type="number" class="input-feild" id="sgoalamount" name="targetamount" placeholder="Saving goal amount.." autofocus>
 -->

                        <h class="sub-title">Saved </h>
                        <input type="number" class="input-feild" id="save" name="save" placeholder="0" autofocus>

                        <!-- <h class="sub-title">Target Date </h>
                        <input type="date" class="input-feild" id="Targetdate" name="targetdate" autofocus> -->

                        <div class="primary-btn flex" id="addgoal" value>Add Saving <ion-icon name="arrow-forward-outline"></ion-icon>
                        </div>
                        <!-- <h class="sub-title">Goal Name </h>
                        <input type="text" class="input-feild" id="name" name="goaltodeletename" placeholder="Saving goal name.." autofocus>

                        <button class="primary-btn flex" id="deletegoal" onclick="confirmDelete('<?php echo htmlspecialchars($_POST['goaltodeletename']); ?>')">Delete goal<ion-icon name="arrow-forward-outline"></ion-icon></button>
 -->

                    </form>
                </div>
            </div>
        </div>



    </div>


    </div>

    <script>
        document.getElementById('addgoal').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default form submission
            document.getElementById('myForm').submit(); // Submit the form
        });
    </script>
<script>
        function confirmDelete(goalname) {
            if (confirm('Are you sure you want to delete this goal?')) {
                // If user confirms, redirect to delete_goal.php with the goal ID
                window.location.href = 'delete_goal.php?id=' + goalname;
            }
        }
    </script>
    <script src="script.js"></script>

</body>

</html>