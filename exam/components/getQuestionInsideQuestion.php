<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./Styles/style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>


<?php
    $q = $_GET['q'];
    require_once("../connect.php");
?>

                <table class="table table-striped">
                    <thead>
                        <tr>

                           <th scope="col">Soru</th>
                           <th scope="col">Cevabı</th>
                           <th scope="col">Kategori</th>
                           <th scope="col">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           $questions_record = mysqli_query ($link,"SELECT question_id, question, correct_answer, category FROM questions WHERE category = '$q' ORDER BY question_id DESC");
                           if($questions_record -> num_rows > 0){
                            while($questions_row = mysqli_fetch_array($questions_record)){
                              if($questions_row["correct_answer"] == 0){
                                          $letter_answer = "A";
                                      }else if($questions_row["correct_answer"] == 1){
                                          $letter_answer = "B";
                                      }else if($questions_row["correct_answer"] == 2){
                                          $letter_answer = "C";
                                      }else if($questions_row["correct_answer"] == 3){
                                          $letter_answer = "D";
                                      }else{$letter_answer = "E";}
                                      $temp= $questions_row['question_id'];
                        ?>
                            <tr>
                                  <td><?php echo $questions_row['question']; ?></td>
                                  <td><?php echo $letter_answer; ?></td>
                                  <td><?php echo $questions_row['category']; ?></td>
                                  <td style="display:flex;">
                                    <a class="btn btn-primary mr-1" href="./components/edit_question.php?questionid=<?php echo $temp; ?>">Düzenle</a>
                                    <a class="btn btn-danger" href="./components/delete_question.php?questionid=<?php echo $temp; ?>">Sil</a>
                                  </td>
                            </tr>
                            <?php
                            }
                          }else{echo "Hiç soru bulunamadı.";}
                        ?>
                    </tbody>
                </table>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
