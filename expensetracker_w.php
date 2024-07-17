<?php
session_start();
include 'connect.php';


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
$username=$_SESSION['username'];
    // $sql_fetch_userid = "SELECT username FROM registration WHERE email = ?";
    // $stmt_fetch_userid = $con->prepare($sql_fetch_userid);
    // $stmt_fetch_userid->bind_param("s", $username);
    // $stmt_fetch_userid->execute();
    // $result_fetch_userid = $stmt_fetch_userid->get_result();
    // $row_fetch_userid = $result_fetch_userid->fetch_assoc();
    // $username = $row_fetch_userid['username'];
    // $stmt_fetch_userid->close();


    $insurance = $_POST['Insurance'];
    $rent = $_POST['Rent'];
    $loan = $_POST['Loan'];
    $transport = $_POST['Transport'];
    $dineouts = $_POST['Dine'];
    $utilities = $_POST['Utilities'];
    $personalcare = $_POST['Personal'];
    $entertainment = $_POST['Entertainment'];
    $clothing = $_POST['Clothing'];
    $miscellaneous = $_POST['Misc'];
    $amount = $insurance + $rent + $loan + $transport + $dineouts + $utilities + $personalcare + $entertainment + $clothing + $miscellaneous;
 
 
    $sql4="select * from expense where username='$username'";
    $result4=mysqli_query($con,$sql4);
    $num4=mysqli_num_rows($result4);
    if($num4>0)
    {
        $sql5="update expense set amount='$amount' where username='$username'";
        mysqli_query($con,$sql5);
    $sql2="update working_expense set insurance='$insurance',rent='$rent',loan='$loan',transport='$transport',dine='$dineouts',utilities='$utilities',personal='$personalcare',enteertainment='$entertainment',clothing='$clothing',misc='miscellaneous'";
    mysqli_query($con,$sql2);
    }
    
    else{
        $sql5="insert into expense (username,amount) values ('$username','$amount')";
        mysqli_query($con,$sql5);
          
$sql1="insert into working_expense(userid,insurance,rent,loan,transport,dine,utilities,personal,entertainment,clothing,misc)
values('$username','$insurance','$rent','$loan','$transport','$dineouts','$utilities','$personalcare','$entertainment','$clothing','$miscellaneous')";
$result=mysqli_query($con,$sql1);

    }
    
  
    // Optionally, you can redirect the user to a confirmation page or reload the current page
    header("Location: w_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <style>
        body {
            padding-left: 200px;
            padding-right: 200px;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-color: black;
            color:yellow;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1
         {
            text-align: center;
            font-size: 50px;
        }
h2{
    text-align: center;

    font-size: 30px;
}
        form {
            margin-top: 20px;
            text-align: center;
            margin: auto;
            justify-content: center;
            color: blueviolet;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="number"] {
            width: 300px;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            text-align: center;
            margin: auto;
            justify-content: center;
            margin-bottom: 20px;
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
    </style>
</head>

<body>
    <h1>Welcome</h1>
    <h2>Track Your Expenses</h2>
    <form method="POST">

        <label for="amount">Insurance:</label>
        <input type="number" name="Insurance" id="amount" min="0" step="0.01" required><br>

        <label for="amount">Rent:</label>
        <input type="number" name="Rent" id="rent" min="0" step="0.01" required><br>

        <label for="amount">Loan:</label>
<input type="number" name="Loan" id="loan" min="0" step="0.01" required><br>

        <label for="amount">Transport:</label>
        <input type="number" name="Transport" id="transport" min="0" step="0.01" required><br>

        <label for="amount">DineOuts:</label>
        <input type="number" name="Dine" id="dine" min="0" step="0.01" required><br>

        <label for="amount">Utilities:</label>
        <input type="number" name="Utilities" id="utilities" min="0" step="0.01" required><br>

        <label for="amount">Personal Care:</label>
        <input type="number" name="Personal" id="personal" min="0" step="0.01" required><br>


        <label for="amount">Entertainment:</label>
        <input type="number" name="Entertainment" id="entertainment" min="0" step="0.01" required><br>


        <label for="amount">Clothing:</label>
        <input type="number" name="Clothing" id="clothing" min="0" step="0.01" required><br>


        <label for="amount">Miscellaneous:</label>
        <input type="number" name="Misc" id="misc" min="0" step="0.01" required><br>


        <button type="submit">Add Expense</button>
    </form>
    <!-- Display list of expenses here -->
</body>

</html>