<?php
    //error_reporting(0);
    // notları karşılaştır sonra filtrele
    include_once '../connect.php';
    session_start();
    $name = $_SESSION['name'];
    $surname = $_SESSION['surname'];
    $paper_id = $pid = $_SESSION['pid'];
    $_SESSION['pid'] = $paper_id;
    $user_id=$_SESSION["id"];
    $postedAnswers = implode(" ",$_POST);
    $postedAnswersArr = explode(" ", $postedAnswers);
    for($i=0;$i<count($postedAnswersArr);$i++){
        if($postedAnswersArr[$i] == 0){
            $postedAnswersArr[$i] = "A";
        }else if($postedAnswersArr[$i] == 1){
            $postedAnswersArr[$i] = "B";
        }else if($postedAnswersArr[$i] == 2){
            $postedAnswersArr[$i] = "C";
        }else if($postedAnswersArr[$i] == 3){
            $postedAnswersArr[$i] = "D";
        }else if($postedAnswersArr[$i] == 4){
            $postedAnswersArr[$i] = "E";
        }else{ $postedAnswersArr[$i] = "BOS";}
    }
    array_pop($postedAnswersArr);

    $chk = "";
    foreach ($postedAnswersArr as $givenAnswer){
        $chk.=$givenAnswer.",";
    }
    $result = mysqli_query($link, "SELECT * FROM papers WHERE paper_id = $paper_id");
    if($result -> num_rows > 0){
        while($row = mysqli_fetch_array($result)){
            $paper_name = $row['paper_name'];
            $paperDuration = $row['paper_duration'];
            $questions = $row['questions'];
            $paper_start = $row['start_date'];
            $paper_end = $row['end_date'];
            $paper_cat = $row['category'];
            $min_pass_score = $row['min_pass_score'];
            $mark_per_question = $row['mark_per_question'];
        }
    }
    $questionsArr = explode(",", $questions);
    $htmlString = $paper_end;
    $m=0;

    for($i=0; $i<count($questionsArr)-1; $i++){
    $record = mysqli_query($link, "SELECT correct_answer FROM questions WHERE question_id = '$questionsArr[$i]'");
    if($record -> num_rows > 0){
        while ($row = mysqli_fetch_array($record)){
          $correct_answer = $row['correct_answer'];
          if($correct_answer == 0){
              $correct_answer = "A";
          }else if($correct_answer == 1){
              $correct_answer = "B";
          }else if($correct_answer == 2){
              $correct_answer = "C";
          }else if($correct_answer == 3){
              $correct_answer = "D";
          }else if($correct_answer == 4){
              $correct_answer = "E";
          }
          $correctAnswerArr[$m] = $correct_answer;
          $m++;
        }
      }
    }
     $chk2 = "";
      foreach ($correctAnswerArr as $c_answer){
          $chk2.=$c_answer.",";
      }

    if(isset($_POST["submit"])){
      $counter = 0;
      for($i = 0; $i < count($postedAnswersArr); $i++){
          if ($postedAnswersArr[$i] == $correctAnswerArr[$i]){
            $counter = $counter + $mark_per_question;
          }
      }
      echo $counter;
      if($counter < $min_pass_score){
        $status = "Başarısız";
      } else if($counter >= $min_pass_score){
        $status = "Başarılı";
      }
        $sql = "INSERT INTO questions_answers (name, surname, paper_id, paper_name, s_id, s_questions, answers, answer_key, s_status, mark, category) VALUES ('$name', '$surname', '$pid','$paper_name', '$user_id', '$questions', '$chk', '$chk2', '$status', '$counter', '$paper_cat')";
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
                <p class="mb-0 text-primary"><?php echo $paper_name; ?> Sınavı</p>
                <footer class="blockquote-footer"><p id="demo"></p></footer>
            </blockquote>
            <hr/>

            <div>
                <form method="post" id="examForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <?php
                    for($i=0;$i<count($questionsArr)-1;$i++){
                        $questionsResult = mysqli_query($link, "SELECT * FROM questions WHERE question_id=$questionsArr[$i]");
                        if($questionsResult -> num_rows > 0){
                            while($questionsRow = mysqli_fetch_array($questionsResult)){
                                $questionId = $questionsRow['question_id'];
                                $question = $questionsRow['question'];
                                $answer1 = $questionsRow['answer1'];
                                $answer2 = $questionsRow['answer2'];
                                $answer3 = $questionsRow['answer3'];
                                $answer4 = $questionsRow['answer4'];
                                $answer5 = $questionsRow['answer5'];
                                ?>
                                <div class="card mb-3"  style="width:600px; margin-right:auto;margin-left:auto;padding:15px;box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);">
                                    <div class="card_body mb-2" style="font-size:14px;">
                                        <?php
                                           echo "$question";
                                        ?>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <?php if (isset($answer1)){

                                            ?>
                                        <li class="list-group-item" style="font-size:14px;">
                                            <label>A) &nbsp; </label>
                                            <input type="radio" name="<?php echo $questionsArr[$i]; ?>" value="0">
                                            <?php echo $answer1;?>
                                        </li>
                                        <?php } ?>
                                        <?php if (isset($answer2)){?>
                                        <li class="list-group-item" style="font-size:14px;">
                                            <label>B) &nbsp; </label>
                                            <input type="radio" name="<?php echo $questionsArr[$i]; ?>" value="1">
                                            <?php echo $answer2?>
                                        </li>
                                        <?php } ?>
                                        <?php if (isset($answer3)){?>
                                        <li class="list-group-item" style="font-size:14px;">
                                            <label>C) &nbsp; </label>
                                            <input type="radio" name="<?php echo $questionsArr[$i]; ?>" value="2">
                                            <?php echo $answer3?>
                                        </li>
                                        <?php } ?>
                                        <?php if (isset($answer4)){?>
                                        <li class="list-group-item" style="font-size:14px;">
                                            <label>D) &nbsp; </label>
                                            <input type="radio" name="<?php echo $questionsArr[$i]; ?>" value="3">
                                            <?php echo $answer4?>
                                        </li>
                                        <?php } ?>
                                        <?php if (isset($answer5)){?>
                                        <li class="list-group-item" style="font-size:14px;">
                                            <label>E) &nbsp; </label>
                                            <input type="radio" name="<?php echo $questionsArr[$i]; ?>" value="4">
                                            <?php echo $answer5?>
                                        </li>
                                        <?php } ?>
                                        <input type="radio" checked="checked" style="display:none;" name="<?php echo $questionsArr[$i]; ?>" value="bos">
                                    </ul>
                                </div>
                                <?php

                            }
                        }else{
                            echo "Sınava soru eklenmediğinden görüntülenecek soru bulumamaktadır.";
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
<script>
    var countDownDate = new Date("<?php echo $htmlString ?>").getTime();
    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("demo").innerHTML = hours + ":"+ minutes + ":" + seconds;
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "Süreniz doldu.";
            //document.getElementById("examForm").submit();
            //window.location.assign("http://localhost/exam/Student/papers.php");
        }
    }, 1000);


    $('body').bind('cut copy paste', function(e) {
        e.preventDefault();
    });

    $(document).keypress(
        function(event){
            if (event.which == '18') {
                event.preventDefault();
            }
        }
    );
</script>
