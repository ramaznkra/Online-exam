<?php
    include_once "../connect.php";
    $id = $_GET['studentiid'];
    $sql = "UPDATE questions_answers SET instance='Geçersiz' WHERE s_id=$id";
    mysqli_query($link, $sql);

    $link -> close();
    header("location: ../dashboard.php");
   
?>