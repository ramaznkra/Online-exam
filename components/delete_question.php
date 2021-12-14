<?php
    include_once "../connect.php";
    $id = $_GET['questionid'];
    $sql = "DELETE FROM questions WHERE question_id=$id";
    mysqli_query($link, $sql);

    $link -> close();
    header("location: ../questions.php");

?>