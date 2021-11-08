<?php
include_once 'sidebar.php';
//connect
require_once "connect.php";
// Define variables and initialize with empty values
/* $question = $answer1 = $answer2 = $answer3 = $answer4 = $answer5 = $correct_answer = $category= "";
$teach_cat = $_SESSION["userCategory"];

if(isset($_POST["submit"])){

    $question = mysqli_real_escape_string($link,$_POST["question"]);
    $answer1 = mysqli_real_escape_string ($link,$_POST["answer1"]);
    $answer2 = mysqli_real_escape_string ($link,$_POST["answer2"]);
    $answer3 = mysqli_real_escape_string ($link,$_POST["answer3"]);
    $answer4 = mysqli_real_escape_string ($link,$_POST["answer4"]);
    $answer5 = mysqli_real_escape_string ($link,$_POST["answer5"]);
    $correct_answer = mysqli_real_escape_string($link,$_POST["correct_answer"]);
    $category =$_POST["Category"];

    $sql = "INSERT INTO questions (question,answer1,answer2,answer3,answer4,answer5,correct_answer,category) VALUES ('$question','$answer1', '$answer2', '$answer3','$answer4','$answer5','$correct_answer','$category')";

    mysqli_query($link, $sql);

//    $default = mysqli_query ($link,"SELECT users FROM category");

    $question = $answer1 = $answer2 = $answer3 = $answer4 = $answer5 = $correct_answer = $category = "";
}

$categories = explode(",", $teach_cat); */
?>

  <!--Content-->
  <div class="content">

    <section>
        <h4>Soruları Görüntüleme ve Hazırlama</h4>
        <hr>
        <div class="container mt-3">
            <br>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Sorular</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Yeni Soru</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                    <h4>Sorular</h4>
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Soru</th>
                            <th scope="col">Cevabı</th>
                            <th scope="col">Kategori</th>
                            <th scope="col" style="width:170px;">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $records = mysqli_query ($link,"SELECT * FROM questions");
                            if($records -> num_rows > 0){
                                while($row = mysqli_fetch_array($records)){
                                    if($row["correct_answer"] == 0){
                                        $letter_answer = "A";
                                    }else if($row["correct_answer"] == 1){
                                        $letter_answer = "B";
                                    }else if($row["correct_answer"] == 2){
                                        $letter_answer = "C";
                                    }else if($row["correct_answer"] == 3){
                                        $letter_answer = "D";
                                    }else{$letter_answer = "E";}
                                    $temp= $row['question_id'];
                        ?>
                        <tr>
                            <td><?php echo $row['question']; ?></td>
                            <td><?php echo $letter_answer; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td>
                                <a class="btn btn-primary" href="./components/edit_question.php?questionid=<?php echo $temp; ?>">Düzenle</a>
                                <a class="btn btn-danger" href="./components/delete_question.php?questionid=<?php echo $temp; ?>">Sil</a>

                            </td>
                        <?php

                                }
                           }else{echo "Hiç soru bulunamadı."; }

                        ?>
                    </tbody>
                </table><br>

                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    <h4>Yeni soru</h4>
                    <div class="card bg-light text-dark">
                        <div class="card-body">
                            <form method="post" action="add_question.php">
                              <select name="Category" style="float:right">
                              <!--    <option value="" disabled selected>Ders Seçiniz</option> -->
                              

                            </select>
                                <div class="form-group">
                                    <label>Soru</label>
                                    <textarea class="form-control" rows="6" name="question"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>A) &nbsp; </label>
                                    <input type="radio" name="correct_answer" value="0">
                                    <label for="correct_answer">Doğru cevap</label>
                                    <textarea class="form-control" rows="4" name="answer1"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>B) &nbsp; </label>
                                    <input type="radio" name="correct_answer" value="1">
                                    <label for="correct_answer">Doğru cevap</label>
                                    <textarea class="form-control" rows="4" name="answer2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>C) &nbsp; </label>
                                    <input type="radio" name="correct_answer" value="2">
                                    <label for="correct_answer">Doğru cevap</label>
                                    <textarea class="form-control" rows="4" name="answer3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>D) &nbsp; </label>
                                    <input type="radio" name="correct_answer" value="3">
                                    <label for="correct_answer">Doğru cevap</label>
                                    <textarea class="form-control" rows="4" name="answer4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>E) &nbsp; </label>
                                    <input type="radio" name="correct_answer" value="4">
                                    <label for="correct_answer">Doğru cevap</label>
                                    <textarea class="form-control" rows="4" name="answer5"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit" name="submit">Kaydet</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
