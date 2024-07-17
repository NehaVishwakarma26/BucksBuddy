<?php
session_start();
include("connect.php");
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $income = $_SESSION['income'];

    $insurance = $_POST['insurance'];
    $rent = $_POST['rent'];
    $loan = $_POST['loan'];
    $transportation = $_POST['transportation'];
    $dine = $_POST['dineOuts'];
    $utilities = $_POST['utilities'];
    $personal = $_POST['personalCare'];
    $entertainment = $_POST['entertainment'];
    $clothing = $_POST['clothing'];
    $miscellaneous = $_POST['miscellaneous'];
    $total = $insurance + $rent + $loan + $transportation + $dine + $utilities + $personal + $entertainment + $clothing + $miscellaneous;
    $_SESSION['total']=$total;


    // Check if the total exceeds the income
    if ($total > $income) {
        $msg = "Your budget is greater than your income";
    } else {
        // Check if the username exists in the working table
        $check_query = "SELECT * FROM working WHERE username = '$username'";
        $check_result = mysqli_query($con, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            // If the username exists, update the budget
            $update_query = "UPDATE working SET insurance = '$insurance', rent = '$rent', loan = '$loan', transportation = '$transportation', dine = '$dine', utilities = '$utilities', personal = '$personal', entertainment = '$entertainment', clothing = '$clothing', misc = '$miscellaneous' WHERE username = '$username'";

            if (mysqli_query($con, $update_query)) {
                header("Location: expensetracker_w.php");
                exit(); // Exit after redirection
            } else {
                echo "Error updating record: " . mysqli_error($con);
            }
        } else {
            // If the username does not exist, insert a new record
            $insert_query = "INSERT INTO working (username, insurance, rent, loan, transportation, dine, utilities, personal, entertainment, clothing, misc) 
                            VALUES ('$username','$insurance', '$rent', '$loan', '$transportation', '$dine', '$utilities', '$personal', '$entertainment', '$clothing', '$miscellaneous')";

            if (mysqli_query($con, $insert_query)) {
                header("Location: w_dashboard.php");
                exit(); // Exit after redirection
            } else {
                echo "Error: " . $insert_query . "<br>" . mysqli_error($con);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>

<body>
    <style>
        body {
            background-color: black;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #navlist {
            text-align: right;
            display: flex;
            font-family: 'Poppins';
            color: white;
            font-size: 20px;
            justify-content: space-between;

        }

        #navlist li {
            align-items: right;
            text-align: right;
            margin: 0 10px;
            /* Add some spacing between items */
            list-style: none;
            color: white;
        }

        #navlist li a {
            color: rgb(228, 220, 220);
            text-decoration: none;
        }

        #navlist li a:hover {
            color: rgb(190, 112, 231);
            border-bottom: 2px solid rgb(116, 26, 164);
        }




        nav {
            display: flex;
            /* Change display to flex */
            justify-content: space-between;
        }

        nav img {
            margin-left: 40px;
        }

        #contact {
            padding: 13px;
            border: 1px solid rgb(0, 0, 0);
            background-color: white;
            color: black;
            animation-name: cont;
            animation-duration: 5s;
            animation-iteration-count: infinite;
            border-radius: 20px;
        }

        #contact :hover {

            color: rgb(190, 112, 231);
            border-bottom: 2px solid rgb(116, 26, 164);

        }

        @keyframes cont {
            0% {
                color: rgb(234, 230, 238);
                top: 0px;
                background-color: rgb(121, 13, 237);
            }

            25% {
                color: rgb(225, 208, 238);
                top: 0px;
                background-color: rgb(139, 58, 226);
            }

            50% {
                color: rgba(191, 142, 237, 0.727);
                top: 40px;
                background-color: rgb(79, 27, 135);
            }

            75% {
                color: rgba(157, 64, 244, 0.727);
                top: 40px;
                background-color: rgb(199, 171, 228);
            }

            100% {
                color: rgba(248, 244, 250, 0.849);
                background-color: rgba(129, 6, 245, 0.919);
                top: 20px;
                text-shadow: 2px 2px 10px rgb(244, 239, 239);
            }
        }

        header {
            color: white;

            font-size: 30px;
        }
    </style>
    <?php
    $base_url = "http://localhost/mpr/studentbudget/";
    ?>
    <nav>
        <img src="logo_s.jpg" width="300px" id="logo">
        <ul id="navlist">
            <li>
                <a href="home.php">Home</a>
            </li>
            <li> <a href="w_dashboard.php">Dashboard</a></li>
            <li ><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Budget Planner</title>
        <style>
            form {
                border: 0px solid yellow;
                background-color: #21142c;
                padding: 20px;
                border-radius: 20px;

            }


            body {
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
                background-color: #000;
                color: #fff;
            }

            .container {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background-color: #000;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                font-size: 48px;
                text-align: center;
                margin-bottom: 20px;
                color: yellow;
            }

            label {
                display: block;
                margin-bottom: 5px;
                color: #ff0;
                font-size: 20px;
            }

            input[type="number"] {
                width: 90%;
                padding: 16px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                color: #fff;
                font-size: 20px;
                font-weight: bolder;
                color: #000;
            }

            button {
                background-color: blueviolet;
                color: white;
                border: none;
                padding: 10px 20px;
                cursor: pointer;
                border-radius: 5px;
                /* Remove margin: auto; and left: 50%; */
                display: block;
                /* Change display to block */
                margin: 20px auto 0;
                font-family: 'Poppins';
                font-size: 20px;
                font-weight: bolder;
            }

            button:hover {
                background-color: #0056b3;
            }

            label img {
                height: 45px;
                width: 45px;
                padding-right: 15px;
            }

            .message {
                color: white;
                font-family: 'Poppins';
                font-size: 20px;
             
            }
        </style>
    </head>

    <body>


        <div class="container">
            <h1>Working Person Budget Planner</h1>
            <d class="message"><?php echo $msg; ?></d>
            <form id="budgetForm" action="workingbudget.php" method="post">
                <label for="rent"><img src="houseicon.png">Rent (Rs):</label>
                <input type="number" id="rent" value="30000" name="rent">
                <label for="insurance"><img src="insuranceicon.png">Insurance (Rs):</label>
                <input type="number" id="insurance" value="3000" name="insurance">
                <label for="loan"><img src="loanicon.png">Loan (Rs):</label>
                <input type="number" id="loan" value="40000" name="loan">
                <label for="transportation"><img src="caricon.png">Transportation Cost (Rs):</label>
                <input type="number" id="transportation" value="6000" name="transportation">
                <label for="dineOuts"><img src="foodicon.png">Dine Outs (Rs):</label>
                <input type="number" id="dineOuts" value="5000" name="dineOuts">
                <label for="utilities"><img src="utilityicon.png">Utilities (Rs):</label>
                <input type="number" id="utilities" value="5000" name="utilities">
                <label for="personalCare"><img src="personal.png">Personal Care items (Rs):</label>
                <input type="number" id="personalCare" value="2000" name="personalCare">
                <label for="entertainment"><img src="tvicon.png">Entertainment (Rs):</label>
                <input type="number" id="entertainment" value="2000" name="entertainment">
                <label for="clothing"><img src="clothicon.png">Clothing (Rs):</label>
                <input type="number" id="clothing" value="2000" name="clothing">
                <label for="miscellaneous"><img src="misc.png">Miscellaneous (Rs):</label>
                <input type="number" id="miscellaneous" value="1000" name="miscellaneous">
                <button type="submit">Calculate Total</button>
            </form>
            <div id="totalBudget"></div>
        </div>



    </body>

    </html>



</body>

</html>
