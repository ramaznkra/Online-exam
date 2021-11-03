<?php
    include_once 'sidebar.php';
    //connect
    require_once "connect.php";
    // Define variables and initialize with empty values
    $question = $answer1 = $answer2 = $answer3 = $answer4 = $correct_answer = $category= "";
    $teach_cat = $_SESSION["userCategory"];

    if(isset($_POST["submit"])){

        $question = mysqli_real_escape_string($link,$_POST["question"]);
        $answer1 = mysqli_real_escape_string ($link,$_POST["answer1"]);
        $answer2 = mysqli_real_escape_string ($link,$_POST["answer2"]);
        $answer3 = mysqli_real_escape_string ($link,$_POST["answer3"]);
        $answer4 = mysqli_real_escape_string ($link,$_POST["answer4"]);
        $correct_answer = mysqli_real_escape_string($link,$_POST["correct_answer"]);
        $category =$_POST["Category"];

        $sql = "INSERT INTO questions (question,answer1,answer2, answer3,answer4,correct_answer,category) VALUES ('$question','$answer1', '$answer2', '$answer3','$answer4','$correct_answer','$category')";

        mysqli_query($link, $sql);

        $question = $answer1 = $answer2 = $answer3 = $answer4 = $correct_answer = $category = "";
    }

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
                            <th scope="col">#</th>
                            <th scope="col">Soru</th>
                            <th scope="col">Cevabı</th>
                            <th scope="col">Kategori</th>
                            <th scope="col" style="width:170px;">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $records = mysqli_query ($link,"SELECT * FROM questions WHERE category='$teach_cat'");
                            if($records -> num_rows > 0){
                                while($row = mysqli_fetch_array($records)){
                                    if($row["correct_answer"] == 0){
                                        $letter_answer = "A";
                                    }else if($row["correct_answer"] == 1){
                                        $letter_answer = "B";
                                    }else if($row["correct_answer"] == 2){
                                        $letter_answer = "C";
                                    }else{$letter_answer = "D";}
                                    $temp= $row['question_id'];
                        ?>
                        <tr>
                            <td><?php echo $row['question_id']; ?></td>
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
                           $link -> close();
                        ?>
                    </tbody>
                </table><br>

                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    <h4>Yeni soru</h4>
                    <div class="card bg-light text-dark">
                        <div class="card-body">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <select name="Category">
                                    <option value="" disabled selected>Ders Seçiniz</option>
                                    <option value="Matematik">Matematik</option>
                                    <option value="İngilizce">İngilizce</option>
                                    <option value="Bilgisayar">Bilgisayar</option>
                                </select>
                                <div class="form-group">
                                    <label>Soru</label>
                                    <textarea class="form-control" rows="6" name="question"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>A)</label></br>
                                    <input type="radio" name="correct_answer" value="0">
                                    <label for="correct_answer">Doğru cevap</label>
                                    <textarea class="form-control" rows="4" name="answer1"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>B)</label></br>
                                    <input type="radio" name="correct_answer" value="1">
                                    <label for="correct_answer">Doğru cevap</label>
                                    <textarea class="form-control" rows="4" name="answer2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>C)</label></br>
                                    <input type="radio" name="correct_answer" value="2">
                                    <label for="correct_answer">Doğru cevap</label>
                                    <textarea class="form-control" rows="4" name="answer3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>D)</label></br>
                                    <input type="radio" name="correct_answer" value="3">
                                    <label for="correct_answer">Doğru cevap</label>
                                    <textarea class="form-control" rows="4" name="answer4"></textarea>
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
