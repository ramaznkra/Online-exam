<?php
    include_once 'sidebar.php';
    $paper_id = $_GET['paperid'];
    $email = $password = "";
    $email_err = $password_err = $login_err = "";

    if(isset($_POST["enter"])){
        if(isset($_POST["kvkk"])){
            echo "<script>alert('checked')</script>";

            // Check if email is empty
            if(empty(trim($_POST["email"]))){
                $email_err = "Email boş bırakılamaz.";
            } else{
                $email = trim($_POST["email"]);
            }
            // Check if password is empty
            if(empty(trim($_POST["password"]))){
                $password_err = "Şifre boş bırakılamaz.";
            } else{
                $password = trim($_POST["password"]);
            }
        }else{
            //echo "<script>alert('Lütfen KVKK metnini okuyup onaylayınız.')</script>";
        }
    }
?>
<div class="content">
    <section>
  <!--  <p><?php // echo "Öğrenci id: ".$_SESSION["second_id"];echo "paper id: ".$paper_id?></p> -->
        <div class="container mt-5">
            <form class="needs-validation" novalidate method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label>E-Mail</label>
                    <input type="email" name="email" placeholder="E-Mail" class="form-control"></input>
                    <div class="invalid-feedback">
                        E-mail boş bırakılamaz.
                    </div>
                </div>
                <div class="form-group">
                    <label>Şifre</label>
                    <input type="password" name="password" placeholder="Şifre" class="form-control"></input>
                    <div class="invalid-feedback">
                        Şifre boş bırakılamaz.
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="kvkk">
                    <label class="form-check-label" for="kvkk">KVKK şartlarını okudum, kabul ediyorum.</label>
                    <div class="invalid-feedback">
                        Lütfen KVKK metnini okuyup onaylayınız.
                    </div>
                </div>
                <div class="form-group">
                </div>
                <div class="form-group">

                    <button type="submit" name="enter" class="btn btn-primary">Sınava Giriş</button>
                </div>
            </form>

    </section>
</div>
