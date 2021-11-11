<?php
    error_reporting(0);
    
    include_once '../connect.php';
    session_start();
    $paper_id = $_GET['paperid'];
    $pid = $_SESSION['pid'];
    $_SESSION['pid'] = $paper_id;
    $user_id=$_SESSION["id"];
    $questionIds =$_POST["questionIds"];

    $result = mysqli_query($link, "SELECT * FROM papers WHERE paper_id=$paper_id");
    if($result -> num_rows > 0){
        while($row = mysqli_fetch_array($result)){
            $paperName = $row['paper_name'];
            $paperDuration = $row['paper_duration'];
            $questions = $row['questions'];
            $start_exam = $row['start_date'];
            $finist_exam = $row['end_date'];
        }
    }
    $questionsArr = explode(",", $questions);

    if(isset($_POST["submit"])){
        /*$chk = "";
        foreach ($questionIds as $questionIdsAnswer){
            $chk.=$questionIdsAnswer.",";
        }*/

        $sql = "INSERT INTO questions_answers (paper_id, s_id) VALUES ('$pid', '$user_id')";
        mysqli_query($link, $sql);
        header("location: papers.php");
    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    </head>
    <body>
        <div class="container pro_content pb-2">
            <blockquote class="blockquote text-right">
                <p class="mb-0 text-primary"><?php echo $paperName; ?> Sınavı</p>
                <footer class="blockquote-footer"><?php echo $paperDuration; ?></footer>
            </blockquote>
            <hr/>
            <div>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <?php 
                
                    for($i=0;$i<count($questionsArr);$i++){
                        $questionsResult = mysqli_query($link, "SELECT * FROM questions WHERE question_id=$questionsArr[$i]");
                        if($questionsResult -> num_rows > 0){
                            while($questionsRow = mysqli_fetch_array($questionsResult)){
                                $question = $questionsRow['question'];
                                $answer1 = $questionsRow['answer1'];
                                $answer2 = $questionsRow['answer2'];
                                $answer3 = $questionsRow['answer3'];
                                $answer4 = $questionsRow['answer4'];
                                $answer5 = $questionsRow['answer5'];
                               
                                ?>
                                <div class="card mb-3"  style="width:600px; margin-right:auto;margin-left:auto;padding:15px;box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);">
                                    <div class="card_body">
                                        <?php
                                           echo "$question";
                                        ?>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <label>A) &nbsp; </label>
                                            <input type="radio" name="<?php echo $questionsArr[$i]; ?>" id="<?php echo $questionsArr[$i]; ?>" value="0">
                                            <?php echo $answer1?>
                                        </li>
                                        <li class="list-group-item">
                                            <label>B) &nbsp; </label>
                                            <input type="radio" name="<?php echo $questionsArr[$i]; ?>" id="<?php echo $questionsArr[$i]; ?>" value="1">
                                            <?php echo $answer2?>
                                        </li>
                                        <li class="list-group-item">
                                            <label>C) &nbsp; </label>
                                            <input type="radio" name="<?php echo $questionsArr[$i]; ?>" id="<?php echo $questionsArr[$i]; ?>" value="2">
                                            <?php echo $answer3?>
                                        </li>
                                        <li class="list-group-item">
                                            <label>D) &nbsp; </label>
                                            <input type="radio" name="<?php echo $questionsArr[$i]; ?>" id="<?php echo $questionsArr[$i]; ?>" value="3">
                                            <?php echo $answer4?>
                                        </li>
                                        <li class="list-group-item">
                                            <label>E) &nbsp; </label>
                                            <input type="radio" name="<?php echo $questionsArr[$i]; ?>" id="<?php echo $questionsArr[$i]; ?>" value="4">
                                            <?php echo $answer5?>
                                        </li>
                                    </ul>
                                </div>
                                <?php
                            }
                            if($i > $questionsResult -> num_rows){break;}
                        }
                    }
                ?>
                <div class="form-group mt-5" style="text-align:center;">
                    <button class="btn btn-primary" type="submit" name="submit">Sınavı Bitir</button>
                </div>
                </form>
          
            </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
</html>

