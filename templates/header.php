<!DOCTYPE HTML> 
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Final Assignment</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div id="container">
        <header id="banner">
            <h1>ASSIGNMENT 3</h1>
            <h3>CRUD OPERATIONS USING PHP AND MYSQL</h3>
        </header>
        <div id="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="member.php">Member</a></li>
                <?php
                session_start();

                //I have set a session variable logged_in to true when a user logs in
                //Based on that the register and logout nav items can be toggled
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                    // User is logged in
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    // User is not logged in
                    echo '<li><a href="register.php">Register</a></li>';
                }
                ?>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="main-content">
