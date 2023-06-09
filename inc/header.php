<?php
include "functions.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    
    <title>Rent A Car</title>
</head>
<body>
<header>
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <a href="index.php">
                    <h3>Rent A Car</h3>
                </a>
            </div>
            <div class="navbar">
                <ul class="nav-items">
                <li>
                    <a class='active' href='index.php'>Home</a>
                </li>
                    <?php 
                    if (isset($_SESSION['user'])) {
                        echo "<li><a href='automjetet.php'>Automjetet</a></li>";
                        echo "<li><a href='rezervimet.php'>Rezervimet</a></li>";
                        if ($_SESSION['user']['role'] == 1) {
                           echo "<li><a href='kategorit.php'>Kategorit</a></li>";
                           echo "<li><a href='perdoruesit.php'>Perdoruesit</a></li>"; 
                        } 
                        echo "<li><a href='dalja.php'>Dalja</a></li>";
                    }else {
                        echo "<li><a href='login.php'>Login</a></li>";
                    }
                    ?>
               
                </ul>
            </div>
        </div>
    </div>
</header>