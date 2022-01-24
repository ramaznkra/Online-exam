<!DOCTYPE html>
<html>
<head>
</head>
<body>


<?php
    $q = $_GET['q'];
    require_once("../connect.php");
?>
                    <div class="card-body"><h5 class="card-title"> &nbsp Sonuçlar</h5>
                          <table class="mb-0 table table-striped">
                           <thead>
                               <tr>
                                   <th>Ad Soyad</th>
                                   <th>Sınav Adı</th>
                                   <th>Puan</th>
                                   <th>Ders</th>
                                   <th>Başarı Durumu</th>
                                   <th>Kabul Durumu</th>
                                   <th>İşlemler</th>
                                   <th>Sınav Detayı</th>
                               </tr>
                           </thead>
                           <tbody>
                             <?php
                             $recordCat = mysqli_query($link,"SELECT * FROM questions_answers WHERE category='$q' ");
                             if($recordCat -> num_rows > 0){
                               while($rowCat = mysqli_fetch_array($recordCat)){
                                 $student_id = $rowCat['s_id'];
                                 $paper_id = $rowCat['paper_id'];
                                 $paperName = $rowCat['paper_name'];
                                 $name = $rowCat['name'];
                                 $surname = $rowCat['surname'];
                                 $mark = $rowCat['mark'];
                                 $category = $rowCat['category'];
                                 $s_status = $rowCat['s_status'];
                                 $instance = $rowCat['instance'];
                            ?>
                               <tr>
                                 <td><?php echo $name, " " ,$surname ?></td>
                                 <td><?php echo $paperName ?></td>
                                 <td><?php echo $mark ?></td>
                                 <td><?php echo $category ?></td>
                                 <td><?php echo $s_status?></td>
                                 <td>
                                   <?php
                                     if($instance==""){
                                       echo "İşlem bekliyor";
                                     }else{
                                       echo $instance;
                                     } ?>
                                 </td>
                                 <td>
                                   <a class="btn btn-primary" href="./components/studentislem.php?studentiid=<?php echo $student_id; ?>">Geçerli</a>
                                   <a class="btn btn-danger" href="./components/studentislem2.php?studentiid=<?php echo $student_id; ?>">Geçersiz</a>
                                 </td>
                                  <td><a class="btn btn-primary" href="./components/examDetayLog.php?std_id=<?php echo $student_id;?>&paper_id=<?php echo $paper_id; ?>">Detayı Görüntüle</td>
                               </tr>
                               <?php
                             }
                           }
                                ?>
                         </tbody>
                       </table>
                      </div>
