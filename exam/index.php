<?php
    session_start();
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        if($_SESSION["second_id"]==1){
            header("location: howto.php");
            exit;
        }else{
            header("location: Student/index.php");
            exit;
        }

    }
    // Include connect file
    require_once "connect.php";

    // Define variables and initialize with empty values
    $email = $password = "";
    $email_err = $password_err = $login_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
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
            $sql = "SELECT * FROM users WHERE email = ?";
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
                        mysqli_stmt_bind_result($stmt, $birthday ,$id, $TC_no, $name,$surname,$email, $hashed_password,$second_id,$created_date,$userimage,$category);
                        if(mysqli_stmt_fetch($stmt)){
                          if($password == $hashed_password){
                                // Password is correct, so start a new session
                                session_start();

                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["TC_no"] = $TC_no;
                                $_SESSION["name"] = $name;
                                $_SESSION["surname"] = $surname;
                                $_SESSION["day_of_birth"] = $birthday;
                                $_SESSION["email"] = $email;
                                $_SESSION["second_id"] = $second_id;
                                $_SESSION["userimage"] = $userimage;
                                $_SESSION["userCategory"] = $category;

                                // Redirect user to welcome page
                                //header("location: howto.php");
                                if($_SESSION["second_id"]==1){
                                    header("location: howto.php");
                                    exit;
                                }else{
                                    header("location: Student/index.php");
                                    exit;
                                }
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

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AI Factory Exam System</title>
        <link rel="stylesheet" href="./Styles/form.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    </head>
    <body>
        <div class="container">
            <div class="row content">
                <div class="col-md-6 mb-3">
                   <img src="./Images/AI-logo.png" class="img-fluid" width="450px"/>
                </div>
                <div class="col-md-6">
                    <h3 class="singin-text mb-3">Giriş</h3>

                    <form method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="E-mail" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <div class="invalid-feedback"><?php echo $email_err; ?></div>
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Şifre" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <div class="invalid-feedback"><?php echo $password_err; ?></div>
                        </div>
                        <div class="form_group">
                            <button class="btn btn-class" type="submit" name="submit">Giriş</button>
                            <p>Hesabınız yok mu? <a href="register.php">Üye Olun</a>.</p>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
</html>
