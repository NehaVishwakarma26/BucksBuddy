<?php
 
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 require "vendor/autoload.php";
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
 
 
session_start();
include 'connect.php';

$fro="nehavishwakarma2607@gmail.com";
$headers="From: $fro";
$email=$_SESSION['email'];
$monthly_expense = array();
$uname=$_SESSION['username'];

$preparedQuery = mysqli_prepare($con, "SELECT amount FROM expense WHERE username=?");
mysqli_stmt_bind_param($preparedQuery, "s", $uname);
mysqli_stmt_execute($preparedQuery);
$result = mysqli_stmt_get_result($preparedQuery);
$row = mysqli_fetch_assoc($result);
$amount = $row['amount'];
mysqli_stmt_close($preparedQuery);


$monthly_expense[0]["label"] = "tuitionfee";
$monthly_expense[1]["label"] = "rent";
$monthly_expense[2]["label"] = "phonebill";
$monthly_expense[3]["label"] = "transport";
$monthly_expense[4]["label"] = "dine";
$monthly_expense[5]["label"] = "school";
$monthly_expense[6]["label"] = "personal";
$monthly_expense[7]["label"] = "entertainment";
$monthly_expense[8]["label"] = "clothing";
$monthly_expense[9]["label"] = "misc";

for ($count = 0; $count < 10; $count++) {
    $label = $monthly_expense[$count]["label"];
    $query = "SELECT `$label` FROM student WHERE userid='$uname'";
    $result = $con->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $monthly_expense[$count]["y"] = $row[$label]*100/$amount;
    } else {
        // Handle query error
    }
}

$budget = array();
$expense = array();

$budget[0]["label"] = "tuitionfee";
$budget[1]["label"] = "rent";
$budget[2]["label"] = "phonebill";
$budget[3]["label"] = "transport";
$budget[4]["label"] = "dine";
$budget[5]["label"] = "school";
$budget[6]["label"] = "personal";
$budget[7]["label"] = "entertainment";
$budget[8]["label"] = "clothing";
$budget[9]["label"] = "misc";


for ($count = 0; $count < 10; $count++) {
    $label = $budget[$count]["label"];
    $query = "SELECT `$label` FROM student WHERE userid='$uname'";
    $result = $con->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $budget[$count]["y"] = $row[$label];
    } else {
        // Handle query error
    }
}


$expense[0]["label"] = "tuitionfee";
$expense[1]["label"] = "rent";
$expense[2]["label"] = "phonebill";
$expense[3]["label"] = "transport";
$expense[4]["label"] = "dine";
$expense[5]["label"] = "school";
$expense[6]["label"] = "personal";
$expense[7]["label"] = "entertainment";
$expense[8]["label"] = "clothing";
$expense[9]["label"] = "misc";

for ($count = 0; $count < 10; $count++) {
    $label = $expense[$count]["label"];
    $query = "SELECT `$label` FROM student_expense WHERE userid='$uname'";
    $result = $con->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $expense[$count]["y"] = $row[$label];
    } else {
        // Handle query error
    }
}

 
?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="report_style.css">
<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	title: {
		text: "Monthly Expense",
        fontColor: "#FFFF00"
	},
	subtitles: [{
		text: "April 2024"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
        indexLabelFontColor: "#ffffff",
		dataPoints: <?php echo json_encode($monthly_expense, JSON_NUMERIC_CHECK); ?>
	}]
});


 

 
 var chart2 = new CanvasJS.Chart("chartContainer2", {
     animationEnabled: true,
     theme: "light2",
     title:{
         text: "Budget vs Expense",
         fontColor: "#FFFF00"
     },
     axisY:{
         includeZero: true
     },
     legend:{
         cursor: "pointer",
         verticalAlign: "center",
         horizontalAlign: "right",
         itemclick: toggleDataSeries
     },
     data: [{
         type: "column",
         name: "Budget",
         indexLabel: "{y}",
         indexLabelFontColor: "#ffffff",
         yValueFormatString: "#0.##",
         showInLegend: true,
         dataPoints: <?php echo json_encode($budget, JSON_NUMERIC_CHECK); ?>
     },{
         type: "column",
         name: "Expense",
         indexLabel: "{y}",
         indexLabelFontColor: "#ffffff",
         yValueFormatString: "#0.##",
         showInLegend: true,
         dataPoints: <?php echo json_encode($expense, JSON_NUMERIC_CHECK); ?>
     }]
 });

 chart.options.backgroundColor = "#000000";

chart.render();

 chart2.options.backgroundColor = "#000000";
 chart2.render();
  
 function toggleDataSeries(e){
     if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
         e.dataSeries.visible = false;
     }
     else{
         e.dataSeries.visible = true;
     }
     chart2.render();
 }
  
 }
</script>
</head>
<body>
<!-- <div id="chartContainer" style="height: 370px; width: 100%;"></div> -->
<nav>
        <div class="topnav">
            <img src="logo-recolored.png" alt="Logo" id="logo">
            <a href="home.php">Home</a>
            <a href="about.html">About Us</a>
            <a href="s_dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
           </div>
        <div class="nav-title">
            Monthly Report
        </div>
    </nav>

    <header class="container">
        <div class="main-title flex">
            <div class="dashborad-title">
                <!-- <h1 class="title">Dashboard</h1> -->
                <!-- <p>Hello! <?php '$username' ?>, Welcome Back. </p> -->
            </div>
        </div>
    </header>

    <main>
    <div class="container">
        <h1>Expense vs Budget Report</h1>
        <div id="chartContainer1" style="height: 370px; width: 100%; margin-bottom: 50px;">
            <!-- <canvas id="expenseChart"></canvas> -->
        </div>
        <div id="chartContainer2" style="width: 70%; margin: auto; margin-bottom: 100px;">
            <!-- <canvas id="expenseChart"></canvas> -->
        </div>
        <div id="suggestions">
    <h2>Suggestions</h2>
    <p>Based on the expense vs budget report:</p>
    <ul>
        <?php
        // Calculate total expenses and total budget
        $totalExpenses = array_sum(array_column($expense, 'y'));
        $totalBudget = array_sum(array_column($budget, 'y'));

        // Check if total expenses exceed total budget
        if ($totalExpenses > $totalBudget) {
            echo "<li>Your total expenses exceed your total budget. Consider reviewing your spending habits and making adjustments to stay within budget.</li>";
        } else {
            echo "<li>Your total expenses are within your total budget. Keep monitoring your spending to maintain financial stability.</li>";
        }

        // Check individual categories
        foreach ($expense as $key => $exp) {
            $expenseAmount = $exp['y'];
            $budgetAmount = $budget[$key]['y'];
            $category = $exp['label'];

            // Check if expense exceeds budget for each category
            if ($expenseAmount > $budgetAmount) {
                $to=$email;
                $subject="Expense Alert for $category";
                $message="Hello from BucksBuddy. You've exceeded your budget for $category. We suggest you to cut down your expenses or update your budget.";
                mail($to,$subject,$message,$headers);
                echo "<li>Your expenses for '$category' exceed your budget for this category. Try to cut down expenses or allocate more budget if necessary.</li>";
            }
        }
        ?>
    </ul>
</div>

    </div>
        </div>
    </main>

        <!-- <footer class="flex container">
            <div class="footer-text">
                
            </div>
            <div class="footer-social-icons flex">
                <a href="https://github.com/Md-Zainulabdin" target="_blank"><ion-icon name="logo-github"></ion-icon></a>
                <a href="https://www.linkedin.com/in/m-zain-ul-abdin/" target="_blank"><ion-icon
                        name="logo-linkedin"></ion-icon></a>
    
            </div>
        </footer> -->
        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <!-- ion-icon File -->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>   