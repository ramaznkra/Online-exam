<?php
//connect
require_once "connect.php";
// Define variables and initialize with empty values
$question = $answer1 = $answer2 = $answer3 = $answer4 = $answer5 = $correct_answer = $category= "";
$teach_cat = $_SESSION["userCategory"];

if(isset($_POST["submit"])){

    $question = mysqli_real_escape_string($_POST["question"]);
    $answer1 = mysqli_real_escape_string ($_POST["answer1"]);
    $answer2 = mysqli_real_escape_string ($_POST["answer2"]);
    $answer3 = mysqli_real_escape_string ($_POST["answer3"]);
    $answer4 = mysqli_real_escape_string ($_POST["answer4"]);
    $answer5 = mysqli_real_escape_string ($_POST["answer5"]);
    $correct_answer = mysqli_real_escape_string($_POST["correct_answer"]);
    $category =$_POST["Category"];

    $sql = "INSERT INTO questions (question,answer1,answer2,answer3,answer4,answer5,correct_answer,category) VALUES ('$question','$answer1', '$answer2', '$answer3','$answer4','$answer5','$correct_answer','$category')";

    mysqli_query($link, $sql);

//    $default = mysqli_query ($link,"SELECT users FROM category");

    echo $question ;

    $question = $answer1 = $answer2 = $answer3 = $answer4 = $answer5 = $correct_answer = $category = "";
}

$categories = explode(",", $teach_cat);

  $i = 0;
  for($i; $i<count($categories); $i++){
    echo "<option value='$categories[$i]'>";
    echo $categories[$i];
    echo "</option>";
  }

  $link -> close();
?>
