<?php
    include_once 'sidebar.php';
    include_once 'connect.php';

    $us_cat = $_SESSION['userCategory'];

    $paper_name = $min_pass_score = $mark_per_question = $paper_duration = $start_date = $end_date = $category ="";
    if(isset($_POST["submit"])){
        $paper_name = trim($_POST["paper_name"]);
        $min_pass_score = trim($_POST["min_pass_score"]);
        $mark_per_question = trim ($_POST["mark_per_question"]);
        $paper_duration = trim($_POST["paper_duration"]);
        $start_date = trim($_POST["start_date"]);
        $end_date = trim ($_POST["end_date"]);
        $questionIds =($_POST["questionIds"]);

        $chk = "";
        foreach ($questionIds as $questionIdsResult){
          $chk.=$questionIdsResult.",";
        }
        $sql = "INSERT INTO papers (paper_name, min_pass_score, mark_per_question, paper_duration, start_date,end_date,questions) VALUES ('$paper_name', '$min_pass_score','$mark_per_question','$paper_duration','$start_date','$end_date','$chk')";
        mysqli_query($link, $sql);
    }

      $categories = explode(",", $us_cat);
?>

  <!--Content-->
<div class="content">
    <section>
        <h4 class="mt-3">Sınav Kağıtları Görüntüleme ve Oluşturma.</h4><hr>
        <div class="container mt-3">
            <br>
            <ul class="nav nav-tabs" id="myTab">
                <li class="nav-item">
                    <a href="#home" class="nav-link active" data-toggle="tab">Kağıtlar</a>
                </li>
                <li>
                    <a href="#menu1" class="nav-link" data-toggle="tab">Yeni Kağıt</a>
                </li>
            </ul>
            <!--tab content-->
            <div class="tab-content">
                <!-- --------------------show page list -------------------- -->
                <div id="home" class="container tab-pane active">
                    <br>
                    <h4>Kağıtlar</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kağıt Adı</th>
                                <th scope="col">Sınav Süresi (dk)</th>
                                <th scope="col">Başlama Tarihi</th>
                                <!--<th scope="col">Toplam Soru Sayısı</th>-->
                                <th scope="col">Bitiş Tarihi</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $result = mysqli_query($link, "SELECT paper_id, paper_name, paper_duration, start_date, end_date FROM papers");
                                if($result -> num_rows > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $temp=$row['paper_id'];
                            ?>
                                <tr>
                                    <td><?php echo $row['paper_id'];?></td>
                                    <td><?php echo $row['paper_name'];?></td>
                                    <td><?php echo $row['paper_duration'];?></td>
                                    <td><?php echo $row['start_date']; ?></td>
                                    <td><?php echo $row['end_date']; ?></td>

                                    <td>
                                        <a class="btn btn-primary" href="./components/edit_paper.php?paperid=<?php echo $temp; ?>">Düzenle</a>
                                        <a class="btn btn-danger" href="./components/delete_paper.php?paperid=<?php echo $temp; ?>">Sil</a>
                                </tr>
                                <?php

                                    }
                                    }else{
                                        echo "Hiç soru kağıdı bulunamadı.";
                                    }
                                    //$link ->close();
                                ?>
                        </tbody>
                    </table>
                </div>
                 <!-- --------------------create page-------------------- -->
                <div id="menu1" class="container tab-pane fade">
                    <br>
                    <h4>Yeni Kağıt</h4>
                    <form method="post" id="paper" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="paper_name">Kağıt Adı:</label>
                                    <input type="text" class="form-control form-control-sm" name="paper_name">
                                </div>
                                <div class="form-group">
                                    <label for="min_pass_score">Minimum Geçme Notu:</label>
                                    <input type="text" class="form-control form-control-sm" name="min_pass_score">
                                </div>
                                <div class="form-group">
                                    <label for="mark_per_question">Soru Başına Puan:</label>
                                    <input type="text" class="form-control form-control-sm" name="mark_per_question">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="paper_duration">Sınav Dakikası (dk):</label>
                                    <input type="text" class="form-control form-control-sm" name="paper_duration" >
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Başlama Zamanı:</label>
                                    <input type="datetime-local" id="picker"class="form-control form-control-sm" name="start_date">
                                </div>
                                <div class="form-group">
                                    <label for="end_date">Bitiş Zamanı:</label>
                                    <input type="datetime-local" class="form-control form-control-sm" name="end_date">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary mb-5" name="submit" type="submit">Oluştur</button>
                        </div>
                        <div class="form-group">
                            <p>Lütfen eklemek istediğiniz soruları seçiniz.</p>
                                <select name="Category">
                                    <option value="" disabled selected>Ders Seçiniz</option>
                                    <?php
                                      $i=0;
                                      for($i; $i<count($categories); $i++){
                                        echo "<option value='$categories[$i]'>";
                                        echo $categories[$i];
                                        echo "</option>";
                                        $records = mysqli_query ($link,"SELECT question_id, question, correct_answer FROM questions WHERE category ='$categories[$i]'");
                                      }
                                    ?>

                              </select>
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


                                            if($records -> num_rows >0){
                                                while($row = mysqli_fetch_array($records)){
                                                    if($row["correct_answer"]==0){
                                                        $letter_answer = "A";
                                                    }else if($row["correct_answer"]==1){
                                                        $letter_answer = "B";
                                                    }else if($row["correct_answer"]==2){
                                                        $letter_answer = "C";
                                                    }else{$letter_answer = "D";}

                                        ?>
                                        <tr>
                                            <td><?php echo $row['question_id']; ?></td>
                                            <td><?php echo $row['question']; ?></td>
                                            <td><?php echo $letter_answer; ?></td>
                                            <td>
                                              <input type="checkbox"
                                                        value="<?php echo $row['question_id']; ?>"
                                                        name="questionIds[]"
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
            </div>
        </div>
    </section>
</div>
