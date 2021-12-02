<?php
    include_once 'sidebar.php';
    include_once 'connect.php';

    $name = $_SESSION['name'];
    $_SESSION['name'] = $name;
    $surname = $_SESSION['surname'];
    $_SESSION['surname'] = $surname;
    $countJoin = $countNotJoin = $countPass = $countFail = $countPaper = $countQuestions = $b = $s_id = 0 ;
    $status = " ";
    $cat = $_SESSION["userCategory"];
    $categories = explode("," , $cat);

    for($i = 0; $i < count($categories); $i++){
    $record = mysqli_query($link,"SELECT * FROM questions_answers WHERE category = '$categories[$i]'");
    if($record -> num_rows > 0){
      while($row = mysqli_fetch_array($record)){
        $id = $row["Id"];
        $paper_id = $row['paper_id'];
        $s_id = $row['s_id'];
        $s_questions = $row['s_questions'];
        $status = $row['status'];
        $category = $row['category'];
        }
      }
    }

    $records = mysqli_query($link,"SELECT count(id) as countSec_id FROM users WHERE second_id = 0 ");
    $data=mysqli_fetch_assoc($records);
    $data['countSec_id'];

    for($i = 0; $i < count($categories); $i++){
    $result = mysqli_query($link,"SELECT count(paper_id) as countPapers_id FROM papers WHERE category = '$categories[$i]'");
    $countPapers = mysqli_fetch_array($result);
    $countPaper = $countPapers['countPapers_id'] + $countPaper ;
     }

     for($i = 0; $i < count($categories); $i++){
     $result1 = mysqli_query($link,"SELECT count(question_id) as countQuestion_id FROM questions WHERE category = '$categories[$i]'");
     $countQuestion = mysqli_fetch_array($result1);
     $countQuestions = $countQuestion['countQuestion_id'] + $countQuestions ;
      }
     if ($s_id > 0) {
     $result1 = mysqli_query($link,"SELECT name, surname FROM users WHERE id = $s_id");
     if($result1 -> num_rows > 0){
       while($rows = mysqli_fetch_array($result1)){
         $name = $rows['name'];
         $surname = $rows['surname'];
       }
     }
   } else {$s_id = "";}

      for($i = 0; $i < count($categories); $i++){
        if ($category === $categories[$i]){
          $countJoin = $data['countSec_id'] + $countJoin;
        }else {$countNotJoin = $data['countSec_id'] - $countJoin;}
      }
    /*  if($s_id > 0){
        $countJoin = $data['countSec_id'] + $countJoin;
      }else {$countNotJoin = $data['countSec_id'] - $countJoin;} */



    if($status == "Başarılı"){
      $countPass++;
    }else if($status == "Başarısız"){
      $countFail++;
    }
       $cat_labels = json_encode($categories);
?>
  <html>
  <head>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

      <link rel="stylesheet" href="./Styles/chart_style.css"/>
  </head>
  <body>
<div class="content">
  <section>
    <div class="app-container app-theme-white body-tabs-shadow">
         <div class="app-main">
                <div class="app-main__outer" style="margin: 50px;">
                    <div class="app-main__inner">
                        <div class="row">
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Sınavlara katılan öğrenci sayısı</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-success"><span><?php echo $countJoin ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Sınavlara katılmayan öğrenci sayısı</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-primary"><span><?php echo $countNotJoin ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Sınavlarda başarılı olan öğrenci sayısı</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-warning"><span><?php echo $countPass; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Sınavlarda başarısız olan öğrenci sayısı</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-danger"><span><?php echo $countFail; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Toplam Sınav Kağıdı Sayısı</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers"><span><?php echo $countPaper; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Toplam Soru Adedi</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-info"><span><?php echo $countQuestions; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <h5 class="card-title">Öğrenci Durumu</h5>
                                                  <div class="bar">
                                                    <canvas id="totalStudent"></canvas>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <h5 class="card-title">Derslere Göre Başarılı ve Başarısız Öğrenci Sayısı</h5>
                                                  <div class="bar">
                                                    <canvas id="examStatus"></canvas>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body"><h5 class="card-title"> &nbsp Sonuçlar</h5>
                                     <table class="mb-0 table table-striped">
                                      <thead>
                                          <tr>
                                            <th>İsim Soyisim<th>
                                            <th>Durum</th>
                                            <th>Puan</th>
                                            <th>Ders</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        for($p = 0; $p < count($categories); $p++){
                                        $recordCat = mysqli_query($link,"SELECT * FROM questions_answers WHERE category ='$categories[$p]'");
                                        if($recordCat -> num_rows > 0){
                                          while($rowCat = mysqli_fetch_array($recordCat)){
                                            $name = $rowCat['name'];
                                            $surname = $rowCat['surname'];
                                            $status = $rowCat['status'];
                                            $mark = $rowCat['mark'];
                                            $category = $rowCat['category'];
                                       ?>
                                          <tr>
                                            <td><?php echo $name, " " ,$surname;?></td>
                                            <td></td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $mark; ?></td>
                                            <td><?php echo $category; ?></td>
                                          </tr>
                                          <?php
                                        }
                                      }
                                        }
                                           ?>
                                    </tbody>
                                  </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
  </section>
</div>

<script  src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>

<script>
var totalStudent = document.getElementById('totalStudent').getContext('2d');
var examStatus = document.getElementById('examStatus').getContext('2d');
var  totalStudent = new Chart(totalStudent, {
    type: 'bar',
    data: {
        labels:<?php echo $cat_labels; ?>,
        datasets: [{
            label: ["Sınava Katıldı"],
            data:[<?php echo $countJoin ?>],
            backgroundColor: ['rgba(0,255,0,1)'],

        },
        {
            label: ["Sınava Katılmadı"],
            data:[<?php echo $countNotJoin ?>],
            backgroundColor: ['rgba(10,31,248,0.7)']
    }]
}
});

      var examStatus = new Chart(examStatus, {
        type: 'bar',
   data: {
   labels:
    <?php echo $cat_labels; ?>
   ,
   datasets: [{
       label:["Başarılı"],
       data:[<?php echo $countPass ?>],
       backgroundColor: ['rgba(246,204,15,1)']
   },
   {
       label:["Başarısız"],
       data:[<?php echo $countFail ?>],
       backgroundColor: ['rgba(247,25,5,1)']
   }
 ]

}

        });
</script>
</body>
  </html>
