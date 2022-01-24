<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./Styles/style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>


<?php
    $std_id = $_GET['std_id'];
    $paper_id = $_GET['paper_id'];
    require_once("../connect.php");
?>
                      <div class="row">
                            <div class="card-body"><h5 class="card-title"> &nbsp Öğrenci Sınav Durumları</h5>
                             <table class="mb-0 table table-striped">
                              <thead>
                                  <tr>
                                    <th>Doğrulanmış</th>
                                    <th>Göz Hataları</th>
                                    <th>Yasaklı Objeler</th>
                                    <th>Fazla Kişi Hatası</th>
                                    <th>Tarih</th>
                                    <th>Fotoğraf</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                $result3 = mysqli_query($link,"SELECT * FROM logs WHERE std_id = '$std_id' AND paper_id='$paper_id' ");
                                if($result3 -> num_rows > 0){
                                  while($log_row = mysqli_fetch_array($result3)){

                                    $std_id = $log_row['std_id'];
                                    $status = $log_row['status'];
                                    $eyes_movement = $log_row['eyes_movement'];
                                    $phone_detected = $log_row['phone_detected'];
                                    $person_detected = $log_row['person_detected'];
                                    $img_log = $log_row['img_log'];
                                    $date = $log_row['date'];
                               ?>
                                  <tr>
                                    <td><?php echo $status ?></td>
                                    <td><?php echo $eyes_movement ?></td>
                                    <td><?php echo $phone_detected ?></td>
                                    <td><?php echo $person_detected ?></td>
                                    <td><?php echo $date ?></td>
                                    <td><?php
                                    if($img_log==="None"){
                                      ?>
                                      Hata Görseli Yoktur
                                      <?php
                                    }else{
                                      ?>
                                       <a href="<?php echo $img_log ?>" target="_blank"> Hata görseli</a>
                                      <?php
                                    }
                                     ?>

                                    </td>
                                  </tr>
                                  <?php
                                }
                              }
                              ?>

                        </tbody>
                      </table>
                      <a href="../dashboard.php" style="float:right" class="btn btn-danger mr-3">Geri Dön</a>
                    </div>
                  </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
