<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Manager</title>
    <style>
        * {
            margin: 0;

            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins",
                sans-serif;
            background-color: #000;

        }

        .body {

            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {

            background-color: #000;
            text-align: center;
            padding: 1px 200px;
            /* Add padding for better spacing */

        }

        h1 {

            font-size: 3rem;
            color: #A979EF;
        }

        .field-list {
            list-style: none;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            /* Add gap between items */
        }

        .fields h2 {
            margin-top: 1rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .fields {
            background-color: #111;
            color: #fff;
            border: 2px solid #A979EF;
            border-radius: 8px;
            padding: 50px;
            text-align: center;
            width: 100%;
            /* Adjust width to fit smaller screens */
            max-width: 200px;
            /* Set maximum width */
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
        }

        .fields:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(57, 255, 20, 0.5);
        }

        .fields img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            height: 15rem;
            width: 20rem;
            /* margin-bottom: 1rem; */
        }

        .topnav {
            padding: 16px 5px;
            padding-left: 20px;
            overflow: hidden;
            background-color: rgb(0, 0, 0);

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
    </style>
</head>

<body>
    <div class="topnav">
        <img src="logo.jpg" alt="Logo">
        <!-- <a href="home.php">Home</a>
        <a href="about.html">About Us</a>
        <a href="profile.html">Profile</a> -->
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <h1>Personal Finance Manager</h1>
        <ul class="field-list">
            <li class="fields">
                <a href="studentbudget.php"><img src="budgeting.png" alt="Budgeting"></a>
                <h2>Budgeting</h2>
                <p>Track your expenses and create budgets to manage your finances effectively.</p>
            </li>
            <li class="fields">
                <a href="expensetracker_s.php"><img src="expensetracking.png" alt="Expense Tracking"></a>
                <h2>Expense Tracking</h2>
                <p>Monitor your daily expenses and categorize them to gain insights into your spending habits.</p>
            </li>
            <li class="fields">
                <a href="bill_reminder.php"><img src="billreminder.png" alt="Bill Reminders"></a>
                <h2>Bill Reminders</h2>
                <p>Never miss a payment by setting up reminders for your bills and recurring expenses.</p>
            </li>
            <li class="fields">
                <a href="report_s.php"><img src="report.jpg" alt="Financial Reports"></a>
                <h2>Check your Report</h2>
                <p>View detailed weekly and monthly reports to track your financial progress.</p>
            </li>
            <li class="fields">
            <a href="savinggoals.php"><img src="savinggoals.png" alt="Saving Goals"></a>
                <h2>Track your Savings</h2>
                <p>Start Your Financial Journey: Define Your Savings Goal and Take Control of Your Future!



                </p>
            </li>
        </ul>
    </div>
</body>

</html>