<?php
    include_once 'sidebar.php';
    include_once '../connect.php';
    $user_id=$_SESSION["id"];
    $category = $status = $mark = "";

?>
  <html>
  <body>
<div class="content">
  <section>
      <div class="card-body"><h5 class="card-title"> &nbsp Sonuçlar</h5>
       <table class="mb-0 table table-striped">
        <thead>
            <tr>
              <th>Ders</th>
              <th>Durum</th>
              <th>Puan</th>
            </tr>
        </thead>
        <tbody>
          <?php

          $record = mysqli_query($link,"SELECT * FROM questions_answers WHERE s_id = $user_id");
          if($record -> num_rows > 0){
            while($row = mysqli_fetch_array($record)){
              $s_id = $row['s_id'];
              $id = $row["Id"];
              $p_id = $row['paper_id'];
              $s_questions = $row['s_questions'];
              $answers = $row['answers'];
              $answer_key = $row['answer_key'];
              $status = $row['status'];
              $mark = $row['mark'];
              $category = $row['category'];

            ?>
            <tr>
              <td><?php echo $category ?></td>
              <td><?php echo $status ?></td>
              <td><?php echo $mark ?></td>
            </tr>
            <?php
          }
        }
             ?>
      </tbody>
    </table>
  </div>
 </section>
</div>

</body>
  </html>
