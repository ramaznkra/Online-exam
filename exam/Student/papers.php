<?php
    include_once 'sidebar.php';
    include_once '../connect.php';

?>

  <!--Content-->
  <div class="content">
    <section>
        <div class="container mt-3">
            <br>
            <ul class="nav nav-tabs" id="myTab">
                <li class="nav-item">
                    <a href="#home" class="nav-link active" data-toggle="tab">Sınavlar</a>
                </li>
            </ul>
            <!--tab content-->
            <div class="tab-content">
                <!-- --------------------show page list -------------------- -->
                <div id="home" class="container tab-pane active">
                    <br/>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Kağıt Adı</th>
                                <th scope="col">Sınav Süresi (dk)</th>
                                <th scope="col">Başlama Tarihi</th>
                                <th scope="col">Bitiş Tarihi</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = mysqli_query($link, "SELECT paper_id, paper_name, paper_duration, start_date, end_date, category FROM papers");
                                if($result -> num_rows > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $temp=$row['paper_id'];
                                        $paper_cat=$row['category'];
                                        $s_time=strval($row['start_date']);

                            ?>
                                <tr>
                                    <td><?php echo $row['paper_name'];?></td>
                                    <td><?php echo $row['paper_duration'];?></td>
                                    <td><?php echo $s_time; ?></td>
                                    <td><?php echo $row['end_date']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td>
                                        <form method="POST" action="check.php">
                                            <a id="<?php echo $temp; ?>" class="btn btn-danger" name="enter"  href="<?php echo "check.php?paperid=".$temp ?>">Sınava Gir</a>
                                            <?php
                                                date_default_timezone_set('Europe/Istanbul');
                                                $dt = date("Y-m-d H:i:00");
                                                strval($dt);
                                                echo "<script>";
                                                    echo "var s_time =".json_encode($s_time).";";
                                                    echo "var temp =".json_encode($temp).";";
                                                    echo "var dty =".json_encode($dt).";";
                                                    echo "if(dty!=s_time){";
                                                        echo "document.getElementById(temp).classList.remove('btn-success');";
                                                        echo "document.getElementById(temp).style.pointerEvents = 'none';";
                                                        echo "document.getElementById(temp).classList.add('btn-danger');";
                                                    echo "}else{";
                                                        echo "document.getElementById(temp).classList.remove('btn-danger');";
                                                        echo "document.getElementById(temp).style.pointerEvents = 'auto';";
                                                        echo "document.getElementById(temp).classList.add('btn-success');";
                                                    echo "}";
                                                echo "</script>";
                                            ?>
                                        </form>
                                </tr>
                                <?php
                                    }
                                    }else{
                                        echo "Hiç soru kağıdı bulunamadı.";
                                    }
                                    $link ->close();
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

</script>
