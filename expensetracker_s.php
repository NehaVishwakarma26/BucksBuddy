<?php
session_start();
include 'connect.php';


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    // $sql_fetch_userid = "SELECT username FROM registration WHERE email = ?";
    // $stmt_fetch_userid = $con->prepare($sql_fetch_userid);
    // $stmt_fetch_userid->bind_param("s", $username);
    // $stmt_fetch_userid->execute();
    // $result_fetch_userid = $stmt_fetch_userid->get_result();
    // $row_fetch_userid = $result_fetch_userid->fetch_assoc();
    // $username = $row_fetch_userid['username'];
    // $stmt_fetch_userid->close(); 

    $tuitionfee = $_POST['Tuitionfee'];
    $rent = $_POST['Rent'];
    $phonebill = $_POST['Phonebill'];
    $transport = $_POST['Transport'];
    $dineouts = $_POST['Dine'];
    $schoolsupplies = $_POST['School'];
    $personalcare = $_POST['Personal'];
    $entertainment = $_POST['Entertainment'];
    $clothing = $_POST['Clothing'];
    $miscellaneous = $_POST['Misc'];
    $amount = $tuitionfee + $rent + $phonebill + $transport + $dineouts + $schoolsupplies + $personalcare + $entertainment + $clothing + $miscellaneous;
    // Prepare the SQL statement
    $sql4="select * from expense where username='$username'";
    $result4=mysqli_query($con,$sql4);
    $num4=mysqli_num_rows($result4);
    if($num4>0)
    {
        $sql5="update expense set amount='$amount' where username='$username'";
        mysqli_query($con,$sql5);
        $sql2="update student_expense set tuitionfee='$tuitionfee',rent='$rent',phonebill='$phonebill',transport='$transport',dine='$dineouts',school='$schoolsupplies',personal=''$personalcare',entertainment='$entertainment',clothing='$clothing',misc='$miscellaneous'";
    mysqli_query($con,$sql2);
    }
    
    else{
        $sql5="insert into expense (username,amount) values ('$username','$amount')";
        mysqli_query($con,$sql5);
        
$sql1="insert into student_expense(userid,tuitionfee,rent,phonebill,transport,dine,school,personal,entertainment,clothing,misc) values ('$username','$tuitionfee','$rent','$phonebill','$transport','$dineouts','$schoolsupplies','$personalcare','$entertainment','$clothing','$miscellaneous')";
$res=mysqli_query($con,$sql1);
    }
    
    

    // $stmt = mysqli_prepare($con, "INSERT INTO student_expense (username, ) VALUES (?, ?)");
    // mysqli_stmt_bind_param($stmt, "ss", $username, $amount);

    // // Execute the prepared statement
    // mysqli_stmt_execute($stmt);

    // // Close the statement
    // mysqli_stmt_close($stmt);

    // Optionally, you can redirect the user to a confirmation page or reload the current page
    header("Location: s_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        body {
            padding-left: 200px;
            padding-right: 200px;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-color: black;
            color: yellow;
            font-family: 'Poppins';
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 50px;
        }

        h2 {
            text-align: center;
            font-size: 50px;
        }

        form {
            margin-top: 20px;
            margin: auto;
            justify-content: center;
            color: blueviolet;
            left: 50%;
            margin-left: 37%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 25px;

        }

        input[type="number"] {
            width: 400px;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            box-sizing: border-box;
            text-align: center;
            margin: auto;
            justify-content: center;
            margin-bottom: 20px;
            height: 40px
        }

        button[type="submit"] {
            width: 150px;
            border-radius: 20px;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .box {
            border: 2px solid #4caf50;
            padding: 20px;
            border-radius: 10px;
            margin-top: 60px;
            margin-right: 450px;
            background-color: #ccccff;
        }

        .outer-box {
            margin-right: 100px;
        }
    </style>
</head>

<body>
    <!-- <h1>Welcome</h1> -->
    <h2>Track Your Expenses</h2>
    <div class="outer-box">
        <form method="POST">
            <div class="box">
                <label for="amount">Tuitionfee:</label>
                <input type="number" name="Tuitionfee" id="amount" min="0" step="0.01" required><br>

                <label for="amount">Rent:</label>
                <input type="number" name="Rent" id="rent" min="0" step="0.01" required><br>

                <label for="amount">Phonebill:</label>
                <input type="number" name="Phonebill" id="phone" min="0" step="0.01" required><br>

                <label for="amount">Transport:</label>
                <input type="number" name="Transport" id="transport" min="0" step="0.01" required><br>

                <label for="amount">DineOuts:</label>
                <input type="number" name="Dine" id="dine" min="0" step="0.01" required><br>

                <label for="amount">School Supplies:</label>
                <input type="number" name="School" id="school" min="0" step="0.01" required><br>

                <label for="amount">Personal Care:</label>
                <input type="number" name="Personal" id="personal" min="0" step="0.01" required><br>


                <label for="amount">Entertainment:</label>
                <input type="number" name="Entertainment" id="entertainment" min="0" step="0.01" required><br>


                <label for="amount">Clothing:</label>
                <input type="number" name="Clothing" id="clothing" min="0" step="0.01" required><br>


                <label for="amount">Miscellaneous:</label>
                <input type="number" name="Misc" id="misc" min="0" step="0.01" required><br>


                <button type="submit">Add Expense</button>
            </div>
        </form>
    </div>
    <!-- Display list of expenses here -->
</body>

</html>