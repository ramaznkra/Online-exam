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
              <th>İsim Soyisim</th>
              <th>Ders Adı</th>
              <th>Sınav Durumu</th>
              <th>Puan</th>
              <th>Kabul Durumu</th>
              <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
          <?php

          $record = mysqli_query($link,"SELECT * FROM questions_answers WHERE s_id = $user_id ORDER BY Id DESC");
          if($record -> num_rows > 0){
            while($row = mysqli_fetch_array($record)){
              $name = $row['name'];
              $surname = $row['surname'];
              $s_id = $row['s_id'];
              $id = $row["Id"];
              $p_id = $row['paper_id'];
              $p_name = $row['paper_name'];
              $s_questions = $row['s_questions'];
              $answers = $row['answers'];
              $answer_key = $row['answer_key'];
              $status = $row['s_status'];
              $instance = $row['instance'];
              $mark = $row['mark'];
              $category = $row['category'];
            ?>
            <tr>
              <td><?php echo $name, " " ,$surname; ?></td>
              <td><?php echo $p_name ?></td>
              <td><?php echo $status ?></td>
              <td><?php echo $mark ?></td>
              <td><?php echo $instance ?></td>
              <td>
                <a class="btn btn-primary" href="../components/studentdetay.php?paperid=<?php echo $p_id; ?>">Sınav Detayları</a>
              </td>
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
