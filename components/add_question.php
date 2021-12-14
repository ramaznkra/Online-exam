<?php
//connect
require_once "../connect.php";
// Define variables and initialize with empty values
$question = $answer1 = $answer2 = $answer3 = $answer4 = $answer5 = $correct_answer = $category= "";

    $question = mysqli_real_escape_string($link,$_POST["question"]);
    $answer1 = mysqli_real_escape_string ($link,$_POST["answer1"]);
    $answer2 = mysqli_real_escape_string ($link,$_POST["answer2"]);
    $answer3 = mysqli_real_escape_string ($link,$_POST["answer3"]);
    $answer4 = mysqli_real_escape_string ($link,$_POST["answer4"]);
    $answer5 = mysqli_real_escape_string ($link,$_POST["answer5"]);
    $correct_answer = mysqli_real_escape_string($link,$_POST["correct_answer"]);
    $category = $_POST["Category"];

    $sql = "INSERT INTO questions (question,answer1,answer2,answer3,answer4,answer5,correct_answer,category) VALUES ('$question','$answer1', '$answer2', '$answer3','$answer4','$answer5','$correct_answer','$category')";

    mysqli_query($link, $sql);

    $question = $answer1 = $answer2 = $answer3 = $answer4 = $answer5 = $correct_answer = $category = "";

    header("location: ../questions.php");


  $link -> close();
?>
