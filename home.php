<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BucksBuddy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>

<body>
    <style>
        body {
            margin-top: 0px;
            background-color: black;
            margin: 0 auto;
            /* Center the content horizontally */
            padding: 0 200px;
        }

        #logo {

            margin-left: 30px;
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


        .line1 {
            color: white;
            font-family: 'Poppins';
            font-size: 70px;
            font-weight: bolder;
            margin-left: 40px;
            margin-top: 50px;

        }

        .featurelist {
            margin-top: -70px;
            list-style: none;
            display: inline-flex;
        }

        .feature {
            width: 250px;
            padding: 20px;
            margin-right: 100px;
            animation-name: features;
            animation-duration: 2s;
            animation-iteration-count: infinite;
            animation-timing-function: ease-out;
            animation-fill-mode: forwards;
        }

        @keyframes features {
            0% {
                opacity: 0.5;
                transform: translate(0px, 0px);
            }

            100% {
                opacity: 1;
                transform: translate(20px, 0px);
            }
        }

        .head {
            font-size: 30px;
            font-family: 'Poppins';
            font-weight: 600;
        }

        .subhead {
            color: white;
            font-family: 'Poppins';

        }

        .featureimg {
            width: 200px;
            height: 200px;
            margin-top: 10px;
        }

        .list1 {
            align-items: center;
        }

        .list2 {
            margin-top: 130px;
            display: flex;

        }

        .featurelist2 {

            list-style: none;

        }

        .head2a {
            font-weight: bold;
            font-size: 80px;
            font-family: 'Poppins';
            width: 500px;
            margin-left: 550px;
            background: linear-gradient(to right, #8106f5ea, #d7c8df);
            color: transparent;
            -webkit-background-clip: text;
            text-align: right;
            align-items: right;
            float: left;

        }


        .head2b {
            font-weight: bold;
            font-size: 80px;
            font-family: 'Poppins';
            width: 500px;
            margin-left: 0px;
            background: linear-gradient(to right, #8106f5ea, #d7c8df);
            color: transparent;
            -webkit-background-clip: text;
            text-align: left;
        }

        .subhead2a {

            color: white;
            font-family: 'Poppins';
            width: 400px;
            margin-left: -400px;
            float: right;
            align-items: right;
            text-align: right;
            margin-top: 380px;

            font-size: 20px;

        }

        .streamline img {
            margin-left: -1090px;
            width: 550px;
            height: 550px
        }

        .subhead2b {
            color: white;
            font-family: 'Poppins';
            width: 400px;
            margin-left: -500px;
            margin-top: 260px;
            font-size: 25px;

        }

        .feature2 {
            display: flex;
            margin-bottom: 100px;
            padding: 0px;
        }

        .subhead2alist {
            font-size: 15px;
            list-style: none;
        }

        #head3 {

            text-align: center;
            font-size: 50px;
            font-family: 'Poppins';
            font-weight: bolder;
            text-shadow: darkorchid;
        }

        .spendingmonitor {
            display: flex;
            padding: 30px;
            padding-bottom: 100px;
            flex-direction: column;
        }

        #subhead3 {
            text-align: center;
            color: white;
            font-family: 'Poppins';
            font-size: 25px;
            font-style: italic;
            margin-top: -30px;
        }

        .spendingmonitor img {
            width: 300px;
            height: 400px;
            float: right;
            align-items: right;
            align-content: right;
            margin-left: 800px;
        }



        .heading4 {
            font-size: 28px;
            font-family: 'Poppins', 'sans', 'arial';
            color: blueviolet;

        }

        .subhead4 {
            font-size: 18px;
            padding-top: 10px;
            padding-bottom: 10px;
            width: 100px
        }

        .savinggoal {
            display: flex;
            text-align: right;
            align-items: right;
            align-content: right;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .section {
            padding-left: 100px;
            /* border: 1px solid rgb(25, 25, 25); */
            padding: 20px;
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            border: 0px solid blueviolet;
            border-radius: 10px;
            margin: 20px;
            background-color: #161421;
        }

        .subheading {
            background-image: linear-gradient(to right, #8106f5, rgba(209, 0, 255, 0.819), rgb(228, 177, 255), rgb(157, 135, 255));
            -webkit-background-clip: text;
            /* Apply background-clip to text for WebKit browsers */
            -moz-background-clip: text;
            /* Apply background-clip to text for Mozilla browsers */
            -ms-background-clip: text;
            /* Apply background-clip to text for Microsoft browsers */
            background-clip: text;
            /* Apply background-clip to text for other browsers */
            color: transparent;
            font-size: 35px;
            padding-left: 40px;
            padding-right: 40px;
            font-family: "Poppins";
        }

        .content {
            text-align: center;
        }

        .image {
            max-width: 100%;
            height: auto;
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            /* Add rounded corners to images */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .image-left {
            margin-right: 20px;
            /* Adjust margin to separate the image from the content */
        }

        .section:nth-child(even) {
            flex-direction: row-reverse;
        }

        /*.animated {
                opacity: 0;
                transform: translateY(50px);
                transition: opacity 0.5s, transform 0.5s;
              }
              
              .animated.show {
                opacity: 1;
                transform: translateY(0);
              }*/

        .section.right .content {
            text-align: left;
            /* Align content left for sections with class 'right' */
        }
    </style>
    <?php
    $base_url = "http://localhost/mpr/";

    ?>
    <nav>
        <img src="<?php echo $base_url . "logo.png" ?>" width="300px" id="logo">
        <ul id="navlist">
         
            <li><a href="#" onclick="redirect_login()">Login</a></li>
            <li> <a href="#" onclick="redirect_sign()">Sign Up</a></li>
            <li class="cont"><a href="<?php echo $base_url."about.php"?>"><span id="contact">About Us</span></a></li>
        </ul>
    </nav>

    <div class="highlight1">
        <p>Empower Your Finances: <font color="yellow"><b>Track</b></color>, <font color="yellow"><b>Save</b></color>
                    <font color="white">and <font color="yellow"><b>Succeed</b></color><br>
                            <font color="white" size="3px">From Expense Tracking to Savings Goals, We've Got You Covered!</font>
        </p>
        <img src="<?php echo $base_url . "mainpic.png" ?>" width="500px">
    </div>

    <!-- features -->
    <p class="line1 animated"> What can you do with BucksBuddy?
    </p>
    <div class="list1">
        <ul class="featurelist">
            <li class="feature animated">
                <img src="<?php echo $base_url . "expensetracking.png" ?>" width="200px" class="featureimg">

                <div class="head animated">Stay on Top of Your Spending</div>
                <div class="subhead">Effortlessly Track Your Expenses for Greater Financial Control! </div>
            </li>
            <li class="feature animated">
                <img src="<?php echo $base_url . "budgeting.png" ?>" width="200px" class="featureimg">
                <div class="head animated">Budget Better, Live Better</div>
                <div class="subhead">Transform Your Financial Future with Our Category Personalised Budgeting Solutions!</div>
            </li>
            <li class="feature animated">
                <img src="<?php echo $base_url . "savinggoals.png" ?>" width="260px" class="featureimg">
                <div class="head "> Secure Your Future</div>
                <div class="subhead">Harness the Power of Saving Goals for Long-Term Financial Success!</div>

            </li>
        </ul>
    </div>

    <div class="list2 animated">
        <ul class="featurelist2">
            <li class="feature2">
                <div class="head2a">Chart Your Financial Course</div>
                <div class="subhead2a">
                    <ul class="subhead2alist">
                        <li>Stay within budget by receiving real-time insights into your expenditures</li><br>
                        <li>Whether you're tracking daily purchases or managing monthly expenses, our comprehensive expense tracking tool empowers you to achieve your financial goals</li>
                    </ul>
                </div>
                <div class="streamline"><img src="<?php echo $base_url . "streamlinefinancialpic.png" ?>"></div>
            </li>



        </ul>

    </div>

    <p id="head3">Real-Time Insights.</p>
    <p id="subhead3">Be informed on your spending.</p>

    <div class="container">
        <div class="section left animated">
            <h2 class="subheading">Track your income seamlessly and never forget to pay your bills!
            </h2>
            <img src="<?php echo $base_url . "billreminder.png" ?>" alt="Image 1" class="image">
        </div>
        <div class="section left animated">
            <h2 class="subheading">Hit those monthly targets like a pro! Let's save together! </h2>
            <img src="<?php echo $base_url . "savinggoalspara.png" ?>" alt="Image 2" class="image"> <!-- Added class for left-aligned image -->

        </div>
        <div class="section left animated">
            <h2 class="subheading">Stay on fleek with your budget game. No crossing lines!</h2>
            <img src="<?php echo $base_url . "budgettracker.png" ?>" alt="Image 3" class="image">
        </div>
    </div>

    <script>
        function redirect_login() {
            window.location.href = "http://localhost/mpr/login.php";
        }

        function redirect_sign() {
            window.location.href = "http://localhost/mpr/sign.php";
        }
    </script>


    <script>
        document.getElementById("contact").addEventListener("click", function() {
            var emailAddress = "nehavishwakarma2607@gmail.com"; // Replace with your email address
            var subject = "Inquiry"; // Optional: You can specify a subject for the email
            var body = ""; // Optional: You can specify a body for the email

            // Construct mailto link
            var mailtoLink = "mailto:" + emailAddress;
            if (subject) {
                mailtoLink += "?subject=" + encodeURIComponent(subject);
            }
            if (body) {
                mailtoLink += "&body=" + encodeURIComponent(body);
            }

            // Open email window
            var emailWindow = window.open(mailtoLink, "_blank");
            if (!emailWindow) {
                alert("Please enable pop-ups to contact us via email.");
            }
        });
    </script>



</body>

</html>