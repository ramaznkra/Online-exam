<?php
    include_once "../connect.php";
    $pid = $_GET['paperid'];
    session_start();
    $sid = $_SESSION["id"];
    $record = mysqli_query($link,"SELECT * FROM questions_answers WHERE paper_id = '$pid' AND s_id='$sid'");
    if($record -> num_rows > 0){
        while($row = mysqli_fetch_array($record)){
          $paper_name = $row['paper_name'];
          $s_questions = $row['s_questions'];
          $answerKey = $row['answer_key'];
          $givenAnswers = $row['answers'];
          $s_status = $row['s_status'];
          $instance = $row['instance'];
          $mark = $row['mark'];
        }
    }
    $s_questionsExp = explode("," , $s_questions);
    $answerKeyExp = explode("," , $answerKey);
    $givenAnswersExp = explode("," , $givenAnswers);
   
?>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    </head>
    <body>
        <div class="container pro_content pb-2">
            <blockquote class="blockquote text-left">
                <p class="mb-0 text-primary">"<?php echo $paper_name; ?>" Sınav Detayınız</p>
                
            </blockquote>
            <div class="displayflex borderBottom">
                <p class="mb-0 text-primary">Sınav Puanınız: &nbsp;</p>
                <p><?php echo $mark ?></p>
            </div>
            <div>
                <?php
                    for($i=0; $i<count($s_questionsExp)-1; $i++){
                        $recordquestions = mysqli_query($link, "SELECT * FROM questions WHERE question_id = '$s_questionsExp[$i]'");
                        while($questionsRow = mysqli_fetch_array($recordquestions)){
                            $questionId = $questionsRow['question_id'];
                            $question = $questionsRow['question'];
                            $answer1 = $questionsRow['answer1'];
                            $answer2 = $questionsRow['answer2'];
                            $answer3 = $questionsRow['answer3'];
                            $answer4 = $questionsRow['answer4'];
                            $answer5 = $questionsRow['answer5'];
                ?>
                <div class="card mb-3 mt-3"  style="width:600px; margin-right:auto;margin-left:auto;padding:15px;box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);">
                    <div class="card_body mb-2" style="font-size:14px;">
                        <?php
                            echo $i+1,")";
                        ?>
                        <?php
                            echo $question;
                        ?>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php
                            if($givenAnswersExp[$i] == $answerKeyExp[$i]){
                                $class="list-group-item bg-success";
                        ?>
                                <li class="<?php echo $class ?>" style="font-size:14px;">
                                    <?php
                                        if($answerKeyExp[$i]=="A"){
                                            echo $answer1;
                                        }else if($answerKeyExp[$i]=="B"){
                                            echo $answer2;
                                        }else if($answerKeyExp[$i]=="C"){
                                            echo $answer3;
                                        }else if($answerKeyExp[$i]=="D"){
                                            echo $answer4;
                                        }else if($answerKeyExp[$i]=="E"){
                                            echo $answer5;
                                        }
                                    ?>
                                </li>
                        <?php
                            }else if($givenAnswersExp[$i] == "BOS"){
                                $class="list-group-item";
                        ?>
                                <li class="list-group-item bg-success mb-2" style="font-size:14px;">
                                    <?php
                                        if($answerKeyExp[$i]=="A"){
                                            echo $answer1;
                                        }else if($answerKeyExp[$i]=="B"){
                                            echo $answer2;
                                        }else if($answerKeyExp[$i]=="C"){
                                            echo $answer3;
                                        }else if($answerKeyExp[$i]=="D"){
                                            echo $answer4;
                                        }else if($answerKeyExp[$i]=="E"){
                                            echo $answer5;
                                        }
                                    ?>
                                </li>
                                <li class="<?php echo $class ?>" style="font-size:14px;">
                                    <?php echo "Boş Bırakılan Soru." ;?>
                                </li>
                        <?php
                            }else if($givenAnswersExp[$i] != $answerKeyExp[$i]){
                        ?>
                                <li class="list-group-item bg-success mb-2" style="font-size:14px;">
                                    <?php
                                        if($answerKeyExp[$i]=="A"){
                                            echo $answer1;
                                        }else if($answerKeyExp[$i]=="B"){
                                            echo $answer2;
                                        }else if($answerKeyExp[$i]=="C"){
                                            echo $answer3;
                                        }else if($answerKeyExp[$i]=="D"){
                                            echo $answer4;
                                        }else if($answerKeyExp[$i]=="E"){
                                            echo $answer5;
                                        }
                                    ?>
                                </li>
                                <li class="list-group-item bg-danger" style="font-size:14px;">
                                    <?php
                                        if($givenAnswersExp[$i]=="A"){
                                            echo $answer1;
                                        }else if($givenAnswersExp[$i]=="B"){
                                            echo $answer2;
                                        }else if($givenAnswersExp[$i]=="C"){
                                            echo $answer3;
                                        }else if($givenAnswersExp[$i]=="D"){
                                            echo $answer4;
                                        }else if($givenAnswersExp[$i]=="E"){
                                            echo $answer5;
                                        }
                                    ?>
                                </li>
                        
                        <?php
                           }
                          
                        ?>
                                
                    </ul>
                </div>
                <?php
                        }
                    }
                ?>

            </div>
           
            

            
        </div>
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        
    </body>
</html>
