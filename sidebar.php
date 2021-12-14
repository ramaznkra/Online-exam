<?php
    // Initialize the session
    session_start();
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
    }
    if($_SESSION["loggedin"]==true && $_SESSION["second_id"]==0){
        header ('location: logout.php');
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AI Factory Exam System</title>
        <link rel="stylesheet" href="./Styles/style.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    </head>
    <body>
        <input type="checkbox" id="check">
        <header>
            <label for="check"><i class="fas fa-bars" id="sidebar_btn"></i></label>
            <div class="left_area"><img class="mini-logo" src="./Images/AI-logo.png"/></div>
            <div class="right_area">
                <a href="logout.php" class="logout_btn">Çıkış</a>
            </div>
        </header>

        <!--Sidebar-->
        <div class="sidebar">
            <a href="howto.php"><i class="fas fa-plus"></i><span>Nasıl Kullanılır</span></a>
            <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            <a href="questions.php"><i class="fas fa-list-alt"></i><span>Sorular</span></a>
            <a href="papers.php"><i class="far fa-sticky-note"></i><span>Kağıtlar</span></a>
            <a href="settings.php"><i class="fas fa-sliders-h"></i><span>Ayarlar</span></a>
        </div>
        <!--Content-->
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
</html>