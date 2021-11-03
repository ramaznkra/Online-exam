<?php
   include_once "../connect.php";
   include_once "./sidebar.php";
   $id = $_GET['paperid'];
   if (isset($_POST["edit"])){
      $paper_name = $min_pass_score = $mark_per_question = $paper_duration = $start_date = $end_date = "";

      $paper_name = mysqli_real_escape_string($link, $_POST["paper_name"]);
      $min_pass_score = mysqli_real_escape_string($link, $_POST["min_pass_score"]);
      $mark_per_question = mysqli_real_escape_string($link, $_POST["mark_per_question"]);
      $paper_duration = mysqli_real_escape_string($link, $_POST["paper_duration"]);
      $start_date = mysqli_real_escape_string($link, $_POST["start_date"]);
      $end_date = mysqli_real_escape_string($link, $_POST["end_date"]);

      $sql = "UPDATE papers SET paper_name = '$paper_name', min_pass_score = '$min_pass_score', mark_per_question = '$mark_per_question', paper_duration = '$paper_duration', start_date = '$start_date', end_date = '$end_date' WHERE paper_id=$_POST[id2]";
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
                    $start_date2 = date("d-m-Y H:i:s",strtotime($row["start_date"]));
                    $end_date2 = date("d-m-Y H:i:s",strtotime($row["end_date"]));

               }
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
                  <label><?php echo $start_date2; ?></label>
                  <input type="datetime-local" class="form-control form-control-sm" name="start_date" value="20-07-2021 02:00">

               </div>
               <div class="form-group">
                  <label for="end_date">Bitiş Tarihi ve Zamanı:</label>
                  <label><?php echo $end_date2; ?></label>
                  <input type="datetime-local" class="form-control form-control-sm" name="end_date" value="<?php echo $end_date; ?>">
               </div>
            </div>
         </div>
         <div class="form-group">
            <p>Lütfen eklemek istediğiniz soruları seçiniz.</p>
            <button class="btn btn-primary" name="select">Soru Seç</button>
            <div class="mt-3" id="list_question" style="heigth=auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Soru</th>
                            <th scope="col">Cevabı</th>
                            <th scope="col">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $records = mysqli_query ($link,"SELECT question_id, question, correct_answer FROM questions");
                            if($records -> num_rows >0){
                                while($row = mysqli_fetch_array($records)){
                                    if($row["correct_answer"]==0){
                                        $letter_answer = "A";
                                    }else if($row["correct_answer"]==1){
                                        $letter_answer = "B";
                                    }else if($row["correct_answer"]==2){
                                        $letter_answer = "C";
                                    }else{$letter_answer = "D";}
                                    $temp= $row['question_id'];
                        ?>
                        <tr>
                            <td><?php echo $row['question_id']; ?></td>
                            <td><?php echo $row['question']; ?></td>
                            <td><?php echo $letter_answer; ?></td>
                            <td>
                                <button class="btn btn-primary" type="submit" value="add_question" name="add_question">Ekle</button>
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
         <div class="form-group">
            <button class="btn btn-primary" name="edit" type="submit">Düzenle</button>
         </div>
      </form>
      </div>
   </section>
</div>
