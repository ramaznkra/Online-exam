<?php
   include_once "../connect.php";
   include_once "./sidebar.php";
   $id=$_GET['questionid'];
   $teach_cat = $_SESSION["userCategory"];
   $categories = explode(",", $teach_cat);

   /*if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['update'])){
        updatef();
    }
    function updatef()
    {
        echo "<script>alert('$id')</script>";
        // do stuff
    }*/



   if (isset($_POST["update"])){
       //echo "<script>alert($_POST[id2])</script>";

       $question = $answer1 = $answer2 = $answer3 = $answer4 = $correct_answer = "";
       $question = mysqli_real_escape_string($link,$_POST["question_d"]);
       $answer1 =  mysqli_real_escape_string($link,$_POST["answer1_d"]);
       $answer2 =  mysqli_real_escape_string($link,$_POST["answer2_d"]);
       $answer3 =  mysqli_real_escape_string($link,$_POST["answer3_d"]);
       $answer4 =  mysqli_real_escape_string($link,$_POST["answer4_d"]);
       $correct_answer =  mysqli_real_escape_string($link,$_POST["correct_answer_d"]);
       $category = $_POST["Category"];


       $sql = "UPDATE questions SET question='$question', answer1='$answer1', answer2='$answer2', answer3='$answer3', answer4='$answer4', correct_answer='$correct_answer' , category ='$category'  WHERE question_id=$_POST[id2]";

       $result =mysqli_query($link,$sql);

       if($result){
           echo "<script>alert('Başarıyla güncellendi')</script>";
       }
       else{
           echo "<script>alert('Güncellenirken bir hata ile karşılaşıldı.')</script>";

       }
       header("location:../questions.php");
   }

?>
<section>

    <div class="content pt-3">
        <h4>Soru Düzenle</h4>

            <?php
                $result = mysqli_query($link, "SELECT question, answer1, answer2, answer3, answer4, answer5, correct_answer , category FROM questions WHERE question_id=$id");
                while ($row = mysqli_fetch_assoc($result)) {
                    $question = $row["question"];
                    $answer1 = $row["answer1"];
                    $answer2 = $row["answer2"];
                    $answer3 = $row["answer3"];
                    $answer4 = $row["answer4"];
                    $answer5 = $row["answer5"];
                    $correct_answer = $row["correct_answer"];
                    $category = $row["category"];
                }
            ?>
        <div class="card bg-light text-dark">
            <div class="card-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id2" value="<?php echo $id; ?>"></input>
                    </div>
                    <select name="Category" style="float:right">
                    <option value="<?php echo $category ?>" selected><?php echo $category ?></option>
                    <?php
                        $i = 0;
                        for($i; $i<count($categories); $i++){
                        echo "<option value='$categories[$i]'>";
                        echo $categories[$i];
                        echo "</option>";
                        }
                    ?>
                  </select>
                    <div class="form-group">
                        <label>Soru</label>
                        <textarea class="form-control" rows="6" name="question_d"><?php echo $question; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>A)</label></br>
                        <input type="radio" name="correct_answer_d" value="0" <?php if($correct_answer==0) print("checked"); ?>>
                        <label for="correct_answer">Doğru cevap</label>
                        <textarea class="form-control" rows="4" name="answer1_d"><?php echo $answer1; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>B)</label></br>
                        <input type="radio" name="correct_answer_d" value="1" <?php if($correct_answer==1) print("checked"); ?>>
                        <label for="correct_answer">Doğru cevap</label>
                        <textarea class="form-control" rows="4" name="answer2_d"><?php echo $answer2; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>C)</label></br>
                        <input type="radio" name="correct_answer_d" value="2" <?php if($correct_answer==2) print("checked"); ?>>
                        <label for="correct_answer">Doğru cevap</label>
                        <textarea class="form-control" rows="4" name="answer3_d"><?php echo $answer3; ?></textarea>
                     </div>
                    <div class="form-group">
                        <label>D)</label></br>
                        <input type="radio" name="correct_answer_d" value="3" <?php if($correct_answer==3) print("checked"); ?>>
                        <label for="correct_answer">Doğru cevap</label>
                        <textarea class="form-control" rows="4" name="answer4_d"><?php echo $answer4; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>E)</label></br>
                        <input type="radio" name="correct_answer_d" value="4" <?php if($correct_answer==4) print("checked"); ?>>
                        <label for="correct_answer">Doğru cevap</label>
                        <textarea class="form-control" rows="4" name="answer5_d"><?php echo $answer5; ?></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit" name="update" >Güncelle</button>
                     <a href="../questions.php" class="btn btn-danger">İptal</a>
                </form>
            </div>
        </div>
    </div>
</section>
