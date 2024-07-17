<?php

session_start();
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_SESSION['username'];

    $sql_fetch_userid = "SELECT id FROM registration WHERE username = ?";
    $stmt_fetch_userid = $con->prepare($sql_fetch_userid);
    $stmt_fetch_userid->bind_param("s", $username);
    $stmt_fetch_userid->execute();
    $result_fetch_userid = $stmt_fetch_userid->get_result();
    $row_fetch_userid = $result_fetch_userid->fetch_assoc();
    $userid = $row_fetch_userid['id'];
    $stmt_fetch_userid->close();

    $sql_check_userid = "SELECT userid FROM userinfo WHERE userid = ?";
    $stmt_check_userid = $con->prepare($sql_check_userid);
    $stmt_check_userid->bind_param("i", $userid);
    $stmt_check_userid->execute();
    $result_check_userid = $stmt_check_userid->get_result();
    if ($result_check_userid->num_rows > 0) {
        // Userid already exists in userinfo table, update the existing record
        $category = $_POST["category"];
        $income = $_POST["income"];
        $age = $_POST["age"];
        $sql_update_userinfo = "UPDATE userinfo SET category = ?, income = ?, age = ? WHERE userid = ?";
        $stmt_update_userinfo = $con->prepare($sql_update_userinfo);
        $stmt_update_userinfo->bind_param("siii", $category, $income, $age, $userid);
        if ($stmt_update_userinfo->execute()) {
            $_SESSION['income'] = $income;
            $base_url = "http://localhost/mpr/";
            if ($category == "student") {
                $redirect = $base_url . "s_dashboard.php";
                header("Location: $redirect");
                exit(); // Stop further execution after redirection
            } else if ($category == "working") {
                $redirect = $base_url . "w_dashboard.php";
                header("Location: $redirect");
                exit(); // Stop further execution after redirection
            } else if ($category == "non-working") {
                $redirect = $base_url . "nw_dashboard.php";
                header("Location: $redirect");
                exit(); // Stop further execution after redirection
            }
        } else {
            echo "Error updating userinfo: " . $stmt_update_userinfo->error;
        }
    } else {
        // Userid does not exist in userinfo table, insert a new record
        $category = $_POST["category"];
        $income = $_POST["income"];
        $age = $_POST["age"];
        $sql_insert_userinfo = "INSERT INTO userinfo (userid, category, income, age) VALUES (?, ?, ?, ?)";
        $stmt_insert_userinfo = $con->prepare($sql_insert_userinfo);
        $stmt_insert_userinfo->bind_param("isis", $userid, $category, $income, $age);
        if ($stmt_insert_userinfo->execute()) {
            $_SESSION['income'] = $income;
            $base_url = "http://localhost/mpr/";
            if ($category == "student") {
                $redirect = $base_url . "s_dashboard.php";
                header("Location: $redirect");
                exit(); // Stop further execution after redirection
            } else if ($category == "working") {
                $redirect = $base_url . "w_dashboard.php";
                header("Location: $redirect");
                exit(); // Stop further execution after redirection
            } else if ($category == "non-working") {
                $redirect = $base_url . "nw_dashboard.php";
                header("Location: $redirect");
                exit(); // Stop further execution after redirection
            }
        } else {
            echo "Error inserting userinfo: " . $stmt_insert_userinfo->error;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Goals Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #000;
            color: yellow;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .container {
            background-color: rgba(17, 17, 17, 0.9);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
            animation: slideIn 1s ease;
            max-width: 400px;
            width: 100%;
            animation-name: form;
            animation-duration: 4s;
        }

        @keyframes form {
            from {
                background-color: #8A2BE2;
                color: white;
            }

            to {
                background-color: rgba(17, 17, 17, 0.9);
                color: yellow;
            }

        }

        @keyframes slideIn {
            from {
                transform: translateY(-100px);
            }

            to {
                transform: translateY(0);
            }
        }

        h2 {
            font-size: 40px;
            margin-bottom: 30px;
            text-align: center;

        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            font-size: 20px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.1);
            color: yellow;
        }

        .form-group select {
            color: blueviolet;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .btn {
            background: linear-gradient(to bottom, #8A2BE2, #4B0082);
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-size: 20px;
            width: 100%;
            font-family: 'Poppins';
            font-weight: bolder;
        }

        .btn:hover {
            background: linear-gradient(to bottom, #4B0082, #8A2BE2);
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Category Form</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <div class="form-group">
                <label for="age">Enter Age</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category">
                    <option value="student">Student</option>
                    <option value="working">Working</option>
                    <option value="non-working">Non-Working</option>
                </select>
            </div>
            <div class="form-group">
                <label for="income">Monthly Income:</label>
                <input type="number" id="income" name="income" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Submit</button>
            </div>
        </form>
    </div>

</body>

</html>