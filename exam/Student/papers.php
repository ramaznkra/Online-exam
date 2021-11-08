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
                            <!--    <th scope="col">#</th> -->
                                <th scope="col">Kağıt Adı</th>
                                <th scope="col">Sınav Süresi (dk)</th>
                                <th scope="col">Başlama Tarihi</th>
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
                                <!--    <td><?php // echo $row['paper_id'];?></td> -->
                                    <td><?php echo $row['paper_name'];?></td>
                                    <td><?php echo $row['paper_duration'];?></td>
                                    <td><?php echo $row['start_date']; ?></td>
                                    <td><?php echo $row['end_date']; ?></td>

                                    <td>
                                        <form method="POST" action="check.php">
                                            <a class="btn btn-danger" name="enter" href="check.php?paperid=<?php echo $temp; ?>">Sınava Gir</a>
                                        </form>
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
            </div>
        </div>
    </section>

</div>
