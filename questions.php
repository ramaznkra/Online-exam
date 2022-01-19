<?php
include_once 'sidebar.php';
//connect
require_once "connect.php";
// Define variables and initialize with empty values
  if(isset($_POST["submit"])){

    $question = $_POST["question"];
    $answer1 = $_POST["answer1"];
    $answer2 = $_POST["answer2"];
    $answer3 = $_POST["answer3"];
    $answer4 = $_POST["answer4"];
    $answer5 = $_POST["answer5"];
    $correct_answer = $_POST["correct_answer"];
    $category = $_POST["Category"];
 }
    $teach_cat = $_SESSION["userCategory"];
    $categories = explode(",", $teach_cat);
?>
<script>
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","./components/getQuestionInsideQuestion.php?q="+ str,true);
    xmlhttp.send();
  }
}
</script>

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
                <div id="home" class="container tab-pane active">
                <br>
                <div style="display: flex;justify-content: space-between;">
                    <div><h4>Sorular</h4></div>
                    <div>
                        <?php
                        if(count($categories)>1){
                        ?>
                        <select onchange="showUser(this.value)">
                           <option value="">Ders Seçiniz</option>
                            <?php
                                $i=0;
                                for($i; $i<count($categories); $i++){
                                    echo "<option value='$categories[$i]'>";
                                    echo $categories[$i];
                                    echo "</option>";
                                }
                            ?>
                        </select>
                        <?php
                        }else{
                        ?>
                            <select onchange="showUser(this.value)" style="display:none;">
                           <option value="">Ders</option>
                            <?php
                                $i=0;
                                for($i; $i<count($categories); $i++){
                                    echo "<option value='$categories[$i]'>";
                                    echo $categories[$i];
                                    echo "</option>";
                                }
                            ?>
                        </select>
                        <?php
                        }
                        ?>
                        
                    </div>
                </div>
                    
                
                  <table id=txtHint class="table table-striped">
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
                      for ($i = 0; $i < count($categories); $i++){
                        $questions_record = mysqli_query($link,"SELECT * FROM questions WHERE category = '$categories[$i]'");
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
                                <td>
                                  <a class="btn btn-primary" href="./components/edit_question.php?questionid=<?php echo $temp; ?>">Düzenle</a>
                                  <a class="btn btn-danger" href="./components/delete_question.php?questionid=<?php echo $temp; ?>">Sil</a>
                                </td>
                          </tr>
                          <?php
                          }
                        }else{echo "Hiç soru bulunamadı.";}
                      }
                       ?>

                    </tbody>
                    </table><br>
                
                    
                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    <h4>Yeni soru</h4>
                    <div class="card bg-light text-dark">
                        <div class="card-body">
                            <form method="post" action="./components/add_question.php">
                              <select name="Category" style="float:right">
                              <option value="" disabled selected>Ders Seçiniz</option>
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
