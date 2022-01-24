<?php
    include_once 'sidebar.php';

    $paper_id = $_GET['paperid'];
     
    if(isset($_POST["submit"])){
        $_SESSION['pid'] = $paper_id;
        header("location: http://localhost/exam/Student/examPage.php");
    }

?>
<div class="content">
    <section>
        <div class="container mt-5">
            <div class="card">
                <div class="card-header" style="background-color:rgba(255, 217, 0);">
                    <h4><strong>Kurallar</strong></h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Sınava girmeden önce sisteme fotoğraf ile yüz tanımlamak zorunludur.</li>
                    <li class="list-group-item">Unutmamalıyızki kamera sınav süresince açık kalmalıdır. Kapatıldığında sınav sonlandırılır.</li>
                    <li class="list-group-item">Sınav süresince sistem tarafından kontrol edilecekler: 
                        <ol>
                            <li>Kameranın açık olup olmadığı.</li>
                            <li>Sınav ortamında sadece sizin olup olmadığınız.</li>
                            <li>Sınav süresince telefon, tablet vb. teknolojik alet kullanımı.</li>
                            <li>Sınav süresince ekranla olan göz temasınız.</li>
                        </ol>
                    </li>
                    <li class="list-group-item">Sistem tarafından kontrol edilen veriler dahilinde aykırı bir durum ile karşılaşıldığında öğretmene mesaj gönderilecektir. Yapılan kontroller sonrasında sınavınız iptal veya geçerli sayılacaktır.</li>
                </ul>
            </div>
            <form class="needs-validation" novalidate method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="chk" name="kvkk">
                    <label class="form-check-label" for="kvkk">KVKK şartlarını okudum, kabul ediyorum.</label>
                    <div class="invalid-feedback">
                        Lütfen KVKK metnini okuyup onaylayınız.
                    </div>
                </div>
                <div class="form-group mt-3">
                    <button class="btn btn-primary" id="send" type="submit" name="submit">Sınava Giriş</button>
                </div>
            </form>
    </section>
</div>
<script>
    $(document).keypress(
        function(event){
            if (event.which == '13') {
                event.preventDefault();
            }
        }
    );
    var checker = document.getElementById('chk');
    var sendbtn = document.getElementById('send');
    checker.unchecked;
    sendbtn.style.pointerEvents = "none";
    checker.onchange= function () {
        if(this.checked){
            sendbtn.style.pointerEvents = "auto";
        }else{
            sendbtn.style.pointerEvents = "none";
        }  
    }
</script>