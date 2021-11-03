<?php
    include_once "../connect.php";
    $id = $_GET['paperid'];
    $sql = "DELETE FROM papers WHERE paper_id=$id";
    mysqli_query($link, $sql);

    $link -> close();
    header("location: ../papers.php");

?>