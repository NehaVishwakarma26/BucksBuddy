<?php
session_start();
include 'connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $uname = $_SESSION['username'];

 
    $currentDate = date('Y-m-d');

    $billName = $_POST['billName'];
    $dueDate = $_POST['dueDate'];

    $query = "INSERT INTO bills (bill_name, due_date, email) VALUES ('$billName', '$dueDate', '$email')";
    $res = mysqli_query($con, $query);

    if ($res) {
        $sql = "SELECT bill_name, due_date FROM bills WHERE due_date = '$currentDate'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $billName = $row['bill_name']; // Fetch the bill name from the database
            
                // Construct the bill link based on the bill name
                if ($billName == 'Gas Cylinder Booking') {
                    $billLink = "https://my.ebharatgas.com/bharatgas/BookCylinder/Index";
                } elseif ($billName == 'Electricity Bill') {
                    $billLink = "https://wss.mahadiscom.in/wss/wss?uiActionName=getViewPayBill";
                } elseif ($billName == 'Water Bill') {
                    $billLink = "https://www.midcindia.org/customers/online-payment/";
                } elseif ($billName == 'Phone Recharge') {
                    $billLink = "https://www.freecharge.in/mobile-recharge";
                }
            
                // Construct the email message with the correct bill link
                $to = $email;
                $subject = "Reminder: Bill Due";
                $message = "Alert!! Today $dueDate is the due date for your $billName. Below is the link to pay the bill: $billLink";
                $headers = "From: nehavishwakarma2607@gmail.com";
            
                if (mail($to, $subject, $message, $headers)) {
                    echo "Email sent successfully";
                } else {
                    echo "Email sending failed: " . error_get_last()['message'];
                }
            }
            
        } else {
            $error = "Error: No bills found for today's due date.";
        }
    } else {
        $error = "Error: Failed to insert bill into the database.";
    }

    // Close the database connection
    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucks Buddy</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="bill.css"> -->
</head>

<body>
    <style>
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        <?php 
        $base_url="http://localhost/mpr/";
        ?>

        body {
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            /* display: flex; */
            /* align-items: center;
            justify-content: center; */
            /* background: url(<?php echo $base_url."wallpaper.jpg"?>) no-repeat; */
            background-color: #000;
            background-position: center;
            background-size: cover;
        }

        .container {
            justify-content: center;
            align-items: center;
            width: 400px;
            height: auto;
            min-height: 400px;
            padding: 30px;
            background: transparent;
            border: 2px solid #e6b7eca1;
            border-radius: 10px;
            backdrop-filter: blur(15px);
            margin: auto;
        }

        h1 {
            color: #eee;
            text-align: center;
            margin-bottom: 36px;
        }

        .input-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .topnav {
            margin-top: 0px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 5px;
    padding-left: 20px;
    overflow: hidden;
    background-color: rgb(0, 0, 0);
}

.topnav a {
    color: #FF6EC7;
    text-align: center;
    padding: 11px 16px;
    text-decoration: none;
    font-size: 17px;
}

.topnav a:hover {
    border-bottom: 2px solid #FF6EC7;
    color: #ffffff;
}

        .todo-input {
            flex: 1;
            outline: none;
            padding: 10px 10px 10px 20px;
            background-color: transparent;
            border: 2px solid #e6b7eca1;
            border-radius: 30px;
            color: #eee;
            font-size: 16px;
            margin-right: 10px;
        }

        .todo-input::placeholder {
            color: #bfbfbf;
        }

        .add-button {
            border: none;
            outline: none;
            background: #e6b7eca1;
            color: #fff;
            font-size: 35px;
            cursor: pointer;
            border-radius: 40px;
            width: 40px;
            height: 40px;
        }

        .empty-image {
            margin: 55px auto 0;
            display: block;
        }

        .todo {
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #463c7b;
            border-radius: 5px;
            margin: 10px 0;
            padding: 10px 12px;
            border: 2px solid #e6b7eca1;
            transition: all 0.2s ease;
        }

        .todo:first-child {
            margin-top: 0;
        }

        .todo:last-child {
            margin-bottom: 0;
        }

        .todo:hover {
            background-color: #e6b7eca1;
        }

        .todo label {
            cursor: pointer;
            width: fit-content;
            display: flex;
            align-items: center;
            font-family: 'Roboto', sans-serif;
            color: #eee;
        }

        .todo span {
            padding-left: 20px;
            position: relative;
            cursor: pointer;
        }

        span::before {
            content: "";
            height: 20px;
            width: 20px;
            position: absolute;
            margin-left: -30px;
            border-radius: 100px;
            border: 2px solid #e6b7eca1;
        }

        input[type='checkbox'] {
            visibility: hidden;
        }

        input:checked+span {
            text-decoration: line-through
        }

        .todo:hover input:checked+span::before,
        input:checked+span::before {
            background: url(<?php $base_url."checked.jpg"?>) 50% 50% no-repeat #09bb21;
            background-size: 100%;
            border-color: #09bb21;
        }

        .todo:hover span::before {
            border-color: #eee;
        }

        .todo .delete-btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: #eee;
            font-size: 24px;
        }

        .todos-container {
            /* margin-top: 100px; */
            height: 300px;
            overflow: overlay;
        }

        .todos-container::-webkit-scrollbar-track {
            background: rgb(247, 247, 247);
            border-radius: 20px
        }

        .todos-container::-webkit-scrollbar {
            width: 0;
        }

        .todos-container:hover::-webkit-scrollbar {
            width: 7px;
        }

        .todos-container::-webkit-scrollbar-thumb {
            background: #d5d5d5;
            border-radius: 20px;
        }

        .filters {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .filter {
            color: #eee;
            padding: 5px 15px;
            border-radius: 100px;
            border: 2px solid #e6b7eca1;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .filter.active,
        .filter:hover {
            background-color: #e6b7eca1;
        }

        .delete-all {
            display: flex;
            color: #eee;
            padding: 7px 15px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .delete-all:hover {
            border-radius: 5px;
            background-color: #e6b7eca1;
        }

        .due-date {
            margin-left: 50px;
            border-radius: 3px;
            border: none;
            outline: none;
            background-color: #463c7b;
            color: #eee;
            /* border: 2px solid #e6b7eca1; */
            padding: 0px 3px;
            transition: all 0.2s ease;
        }

        /* .due-date:hover, .due-date:active {
  background-color:#e6b7eca1;
} */

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(100%);
        }

        .todo:hover .due-date {
            background-color: #e6b7eca1;
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
            color: white;
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

        .highlight1 {
            display: flex;
            color: white;
            font-family: 'Poppins';
            font-size: 50px;
            text-align: left;
            margin-top: 100px;
            justify-content: space-between;
        }

        .highlight1 p {
            width: 600px;
            transition: ease-in;
            animation-name: heading;
            animation-duration: 3s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
            margin-left: 30px;

        }

        @keyframes heading {
            0% {
                top: 200px;
                /* You might want to use translateY for vertical animation */
            }

            50% {
                transform: translate(40px, 0px);
                /* Corrected syntax for translation */
            }
        }

        .highlight1 img {
            text-align: right;
            align-items: right;
            margin-right: 10px;

        }

        .heading-text {
            font-weight: bold;
            color: #ffff00;

        }

        #contact {
            padding: 13px;
            border: 1px solid rgb(0, 0, 0);
            background-color: white;
            color: black;
            animation-name: cont;
            animation-duration: 5s;
            animation-iteration-count: infinite;

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
        
    </style>
    <!-- <div class="topnav">
            <img src="logo-recolored.png" alt="Logo" id="logo">
            <a href="home.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="s_dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
    </div> -->

     <?php
    $base_url = "http://localhost/mpr/";

    ?>
    <header>    <nav>
        <img src="<?php echo $base_url . "logo.png" ?>" width="300px" id="logo">
        <ul id="navlist">
         
            <li><a href="home.php" >Home</a></li>
            <li> <a href="logout.php">Logout</a></li>
        </ul>
    </nav></header>
 

    <div class="container">
        <h1>Bill List</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-container">
                <input class="todo-input" type="text" name="billName" placeholder="Add a new bill...">
                <input class="due-date" type="date" name="dueDate">
                <button type="submit" class="add-button">
                    <i class="fa fa-plus-circle"></i>
                </button>
            </div>
        </form>
        <!-- Display success or error message if set -->
        <?php if (isset($message)) : ?>
            <div class="success"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <!-- End of success or error message -->
        <div class="filters">
            <div class="filter" data-filter="completed">Complete</div>
            <div class="filter" data-filter="pending">Incomplete</div>
            <div class="delete-all">Delete All</div>
        </div>
        <div class="todos-container">
            <ul class="todos"></ul>
            <!-- <img class="empty-image" src="./empty.svg"> -->
        </div>
    </div>
    <script>
    // JavaScript code here
    const input = document.querySelector(".todo-input");
    const addButton = document.querySelector(".add-button");
    const todosHtml = document.querySelector(".todos");
    let todosJson = JSON.parse(localStorage.getItem("todos")) || [];
    const deleteAllButton = document.querySelector(".delete-all");
    const filters = document.querySelectorAll(".filter");
    let filter = '';

    showTodos();

    function getTodoHtml(todo, index) {
        let checked = todo.status === "completed" ? "checked" : "";
        return `
        <li class="todo" data-status="${todo.status}">
            <label>
                <input type="checkbox" id="${index}" onclick="updateStatus(this)" ${checked}>
                <span class="${checked}">${todo.name}</span>
            </label>
            <span class="due-date">${todo.dueDate}</span>
            <button class="delete-btn" data-index="${index}" onclick="remove(this)"><i class="fa fa-times"></i></button>
        </li>`;
    }

    function showTodos() {
        todosHtml.innerHTML = '';
        let filteredTodos = todosJson;
        if (filter === 'completed') {
            filteredTodos = todosJson.filter(todo => todo.status === 'completed');
        } else if (filter === 'pending') {
            filteredTodos = todosJson.filter(todo => todo.status === 'pending');
        }
        if (filteredTodos.length > 0) {
            todosHtml.innerHTML = filteredTodos.map(getTodoHtml).join('');
        }
    }

    function addTodo() {
        const billName = input.value.trim();
        const dueDate = document.querySelector("[name='dueDate']").value.trim();
        if (!billName || !dueDate) {
            return;
        }
        const newTodo = {
            name: billName,
            dueDate: dueDate,
            status: "pending"
        };
        todosJson.unshift(newTodo);
        localStorage.setItem("todos", JSON.stringify(todosJson));
        showTodos();
    }

    // Event listeners for adding a todo
    input.addEventListener("keyup", e => {
        if (e.key === "Enter") {
            addTodo();
        }
    });

    addButton.addEventListener("click", () => {
        addTodo();
    });

    // Function to update the status of a todo
    function updateStatus(todo) {
        const index = todo.id;
        let todoItem = todosJson[index];
        todoItem.status = todo.checked ? "completed" : "pending";
        localStorage.setItem("todos", JSON.stringify(todosJson));
        showTodos();
    }

    // Function to remove a todo
    function remove(todo) {
        const index = todo.dataset.index;
        todosJson.splice(index, 1);
        localStorage.setItem("todos", JSON.stringify(todosJson));
        showTodos();
    }

    // Event listener for filtering todos
    filters.forEach(function (el) {
        el.addEventListener("click", (e) => {
            filters.forEach(tag => tag.classList.remove('active'));
            el.classList.add('active');
            filter = e.target.dataset.filter;
            showTodos();
        });
    });

    // Event listener for deleting all todos
    deleteAllButton.addEventListener("click", () => {
        todosJson = [];
        localStorage.setItem("todos", JSON.stringify(todosJson));
        showTodos();
    });
</script>
</body>

</html>