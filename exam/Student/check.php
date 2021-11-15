<?php
    include_once 'sidebar.php';
    include_once '../connect.php';

    $paper_id = $_GET['paperid'];
    $email = $password = "";
    $email_err = $password_err = $login_err = "";
    
    if(isset($_POST["submit"])){

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

            if(empty($email_err) && empty($password_err)){
            $sql = "SELECT email,pass FROM users WHERE email = ? AND second_id=0";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                // Set parameters
                $param_email = $email;

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);

                    // Check if email exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt,$email, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                $_SESSION['pid'] = $paper_id;
                                header("location: http://localhost/exam/Student/examPage.php");
                            } else{
                                // Password is not valid, display a generic error message
                                $login_err = "Geçersiz Email veya şifre.";
                            }
                        }
                    } else{
                        // Username doesn't exist, display a generic error message
                        $login_err = "Geçersiz Email veya şifre.";
                    }
                }else{
                    echo "Oops! Bi'şeyler ters gitti. Daha sonra tekrar deneyiniz.";
                }
                mysqli_stmt_close($stmt);
            }
        }
    }

?>
<div class="content">
    <section>
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