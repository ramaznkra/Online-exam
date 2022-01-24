<?php
   include_once "../connect.php";
   include_once "./sidebar.php";
   $id = $_GET['paperid'];
   $us_cat = $_SESSION['userCategory'];
   $categories = explode(",", $us_cat);



   if (isset($_POST["edit"])){
     $paper_name = $min_pass_score = $mark_per_question = $paper_duration = $start_date = $end_date = "";

      $paper_name = mysqli_real_escape_string($link, $_POST["paper_name"]);
      $min_pass_score = mysqli_real_escape_string($link, $_POST["min_pass_score"]);
      $mark_per_question = mysqli_real_escape_string($link, $_POST["mark_per_question"]);
      $paper_duration = mysqli_real_escape_string($link, $_POST["paper_duration"]);
      $start_date = mysqli_real_escape_string($link, $_POST["start_date"]);
      $end_date = mysqli_real_escape_string($link, $_POST["end_date"]);
      $paper_cat = mysqli_real_escape_string($link,$_POST["category"]);
      $questionIds =($_POST["questionIds"]);
      $chk = "";
      foreach ($questionIds as $questionIdsResult){
        $chk.=$questionIdsResult.",";
      }

      $sql = "UPDATE papers SET paper_name = '$paper_name', min_pass_score = '$min_pass_score', mark_per_question = '$mark_per_question', paper_duration = '$paper_duration', start_date = '$start_date', end_date = '$end_date', category = '$paper_cat' , questions = '$chk'  WHERE paper_id=$_POST[id2]";
      $result =mysqli_query($link,$sql);
      if($result){
         echo "<script>alert('Başarıyla güncellendi')</script>";
     }
     else{
         echo "<script>alert('Güncellenirken bir hata ile karşılaşıldı.')</script>";
     }
     header("location: ../papers.php");

   }

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
    xmlhttp.open("GET","getQuestions.php?q="+ str + "&paperid=" + <?php echo $id ?>,true);
    xmlhttp.send();
  }
}
</script>
<div class="content pt-3">
   <section>
      <h4>Sayfa Düzenle</h4>
      <div class="container">
      <form method="post" id="paper" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
         <?php
               $result = mysqli_query($link, "SELECT * FROM papers WHERE paper_id=$id");
               while ($row = mysqli_fetch_assoc($result)) {
                    $paper_name = $row["paper_name"];
                    $min_pass_score = $row["min_pass_score"];
                    $mark_per_question = $row["mark_per_question"];
                    $paper_duration = $row["paper_duration"];
                    $start_date2  = date("Y-m-d\TH:i",strtotime($row["start_date"]));
                    $end_date2 = date("Y-m-d\TH:i",strtotime($row["end_date"]));
                    $questions = $row["questions"];
                    $paper_cat = $row["category"];
               }
                    $questions_chk = explode(",", $questions);


         ?>
         <div class="row">
            <div class="col">
               <input type="hidden" class="form-control form-control-sm" name="id2" value="<?php echo $id; ?>">
                  <div class="form-group">
                     <label for="paper_name">Kağıt Adı:</label>
                     <input type="text" class="form-control form-control-sm" name="paper_name" value="<?php echo $paper_name; ?>">
                  </div>
                  <div class="form-group">
                     <label for="min_pass_score">Minimum Geçme Notu:</label>
                     <input type="text" class="form-control form-control-sm" name="min_pass_score" value="<?php echo $min_pass_score; ?>">
                  </div>
                  <div class="form-group">
                     <label for="mark_per_question">Soru Başına Puan:</label>
                     <input type="text" class="form-control form-control-sm" name="mark_per_question" value="<?php echo $mark_per_question; ?>">
                  </div>
            </div>
            <div class="col">
               <div class="form-group">
                  <label for="paper_duration">Sınav Dakikası (dk):</label>
                  <input type="text" class="form-control form-control-sm" name="paper_duration" value="<?php echo $paper_duration; ?>">
               </div>
               <div class="form-group">
                  <label for="start_date">Başlama Tarihi ve Zamanı:</label>
                  <input type="datetime-local" class="form-control form-control-sm" name="start_date" value="<?php echo $start_date2; ?>">

               </div>
               <div class="form-group">
                  <label for="end_date">Bitiş Tarihi ve Zamanı:</label>
                  <input type="datetime-local" class="form-control form-control-sm" name="end_date" value="<?php echo $end_date2; ?>">
               </div>
            </div>
         </div>
         <div>
            <select name="category" style="float:left"  onchange="showUser(this.value)">
               <option value="<?php echo $paper_cat; ?>" selected><?php echo $paper_cat ?></option>
               <?php
                  $i = 0;
                  for($i; $i<count($categories); $i++){
                  echo "<option value='$categories[$i]'>";
                  echo $categories[$i];
                  echo "</option>";
                  }
               ?>
            </select>

         </div>
              <a href="../papers.php" style="float:right" class="btn btn-danger">İptal</a>
              <button class="btn btn-primary mr-1" style ="float:right" name="edit" type="submit">Kaydet</button>

              <div class="form-group" style="float:right">
              </br> <p>Eklemek istediğiniz soruları seçerek kaydet butonuna basınız.</p>
               <br>
            <div id="txtHint" class="mt-3" style="heigth=auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Soru</th>
                           <th scope="col">Cevabı</th>
                           <th scope="col">Kategori</th>
                           <th scope="col">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           $records = mysqli_query ($link,"SELECT question_id, question, correct_answer, category FROM questions WHERE category = '$paper_cat'");
                           if($records -> num_rows >0){
                                 while($row = mysqli_fetch_array($records)){
                                    if($row["correct_answer"]==0){
                                        $letter_answer = "A";
                                    }else if($row["correct_answer"]==1){
                                        $letter_answer = "B";
                                    }else if($row["correct_answer"]==2){
                                        $letter_answer = "C";
                                    }else if($row["correct_answer"]==3){
                                        $letter_answer = "D";
                                    } else{$letter_answer = "E";}
                                    $temp= $row['question_id'];
                        ?>
                        <tr>
                            <td><?php echo $row['question_id']; ?></td>
                            <td><?php echo $row['question']; ?></td>
                            <td><?php echo $letter_answer; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td>
                              <input type="checkbox"
                                    value="<?php echo $row['question_id']; ?>"
                                    name="questionIds[]"
                                    <?php echo (in_array($temp,$questions_chk,TRUE)) ? 'checked="checked"' : ''; ?>
                                />
                            </td>
                        <?php
                                }
                        }else{echo "Hiç soru bulunamadı."; }

                        $link -> close();
                        ?>
                    </tbody>
                </table>
            </div>
         </div>

      </form>
      </div>
   </section>
</div>
