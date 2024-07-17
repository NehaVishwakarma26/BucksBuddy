<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - BucksBuddy</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
         body {
            color:white;
            margin-top: 0px;
            background-color: black;
            margin: 0 auto;
            /* Center the content horizontally */
            padding: 0 200px;
            font-family: 'Poppins';
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

main h2{
    font-size: 35px;
    font-family: 'Poppins';
    color: yellow;
}



    </style>
</head>
<body>
    <?php
    $base_url="http://localhost/mpr/";
    ?>
    <nav>
        <img src="<?php echo $base_url . "logo.png" ?>" width="300px" id="logo">
        <ul id="navlist">
            <li>
                <a href="<?php echo $base_url."home.php"?>">Home</a>
            </li>
            <li><a href="<?php echo $base_url."login.php"?>" onclick="redirect_login()">Login</a></li>
            <li><a href="<?php echo $base_url."sign.php"?>" onclick="redirect_sign()">Sign Up</a></li>
        </ul>
    </nav>
    <main>
        <section class="mission">
            <h2>Our Mission</h2>
            <p>Our mission at BucksBuddy is to provide innovative financial solutions that cater to the diverse needs of our users. Whether you're budgeting for the first time, tracking expenses, or planning for the future, we're here to support you every step of the way.</p>
        </section>
        <section class="team">
            <h2>Meet the Team</h2>
                <p>As second-year students from Thadomal Shahani Engineering College, we bring a blend of enthusiasm and technical expertise to BucksBuddy. Collaborating closely, we've seamlessly integrated our skills in both frontend and backend development to craft a cohesive and efficient platform. Working together, we've harnessed our individual strengths to contribute to both frontend and backend development. From crafting intuitive user interfaces to implementing robust backend functionalities, each team member has played a pivotal role in bringing BucksBuddy to life. Driven by our passion for innovation and technology, we're committed to continuously improving BucksBuddy to meet the evolving needs of our users. With dedication and perseverance, we strive to make BucksBuddy a trusted companion in managing finances effectively.</p>
            
        </section>
    </main>
</body>
</html>
