<?php
    include_once 'sidebar.php';
    include_once 'connect.php';

    $teach_cat = $_SESSION["userCategory"];
    $categories = explode(",", $teach_cat);

       for ($i = 0; $i < count($categories); $i++) {
       $result = mysqli_query($link,"SELECT paper_id, paper_name, category FROM papers WHERE category = '$categories[$i]'");
       while ($row = mysqli_fetch_assoc($result)) {
            $paper_id = $row["paper_id"];
            $paper_name = $row["paper_name"];
            $paper_cat = $row["category"];
       }
       $record = mysqli_query($link,"SELECT question_id, category FROM questions WHERE category = '$categories[$i]'");
       while ($row = mysqli_fetch_assoc($record)){
         $question_id = $row['question_id'];
         $question_cat = $row['category'];
       }
       }
?>
  <html>
  <head>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="value_chart.js"></script>
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
                                            <div class="widget-heading">Sınava katılan öğrenci sayısı</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-success"><span>3</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Sınavdan geçer not alan öğrenci sayısı</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-primary"><span>15</span></div>
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
                                            <div class="widget-numbers text-warning"><span>64</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Sınava katılmayan öğrenci sayısı</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-danger"><span>16</span></div>
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
                                            <div class="widget-numbers"><span>16 dk</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Ders sayısı</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-info"><span>10</span></div>
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
                                                  <div class="pie">
                                                    <canvas id="totalStudent"></canvas>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <h5 class="card-title">Dersler</h5>
                                                  <div class="pie">
                                                    <canvas id="totalQuestion"></canvas>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
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
<script type="text/javascript" src="./assets/scripts/main.js">
</script>



<script type="text/javascript" src="./assets/scripts/my_chart.js">
</script>
<script  src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
</body>
<script>
var totalStudent = document.getElementById('totalStudent').getContext('2d');
var totalQuestion = document.getElementById('totalQuestion').getContext('2d');

var  totalStudent = new Chart(totalStudent, {
    type: 'doughnut',
    data: {
        labels:['Sınava katılan','Sınava katılmayan'],
        datasets: [{
            label: '# of Votes',
            data:[732,834],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    }

});
var  totalQuestion = new Chart(totalQuestion, {
    type: 'doughnut',
    data: {
        labels:['Sınava katılan','Sınava katılmayan'],
        datasets: [{
            label: '# of Votes',
            data:[732,834],
            backgroundColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 159, 64, 1)'

            ],
            borderColor: [
              'rgba(75, 192, 192, 1)',
              'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    }

});
</script>
  </html>
