<?php
// Include connect file
require_once "connect.php";


// Define variables and initialize with empty values
$name = $surname = $email = $password = $confirm_password = $base64ImgPHP = "";
$name_err = $surname_err = $email_err = $password_err = $confirm_password_err = $base64ImgPHP_err = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $base64ImgPHP = $_POST["base64ImgPHP"];

    //Validate name
    if(empty($_POST['name'])){
        $name_err = "İsim boş bırakılamaz.";
    }else{
        $name = trim($_POST["name"]);
    }
    //Validate surname
    if(empty($_POST['surname'])){
        $surname_err = "Soyisim boş bırakılamaz";
    }else{
        $surname = trim($_POST["surname"]);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Email boş bırakılamaz.";
    }else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "Bu email ile kayıt mevcut.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Bi'şeyler ters gitti. Daha sonra tekrar deneyin.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Şifre boş bırakılamaz";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Şifre en az 6 karakter olmalıdır.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Lütfen şifrenizi doğrulayın.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Şifreler aynı değil!";
        }
    }


    // Check input errors before inserting in database
    if(empty($name_err) && empty($surname_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($base64ImgPHP_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (name,surname,image,category, email, pass) VALUES ('$name','$surname','$base64ImgPHP', '' ,?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);

            // Set parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Oops! Bi'şeyler ters gitti. Daha sonra tekrar deneyin.";
            }

            // Close statement
            mysqli_stmt_close($stmt);


        }else{echo "mysqli_prepare() dışına çıktı.";}

    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./Styles/form.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
<div class="container">
            <div class="row content">
                <div class="col-md-6 mb-3">
                    <img src="./Images/AI-logo.png" class="img-fluid"  width="450px"/>
                    <form class="mt-4">

                        <div class="form-group">
                            <div id="my_camera"></div><hr/>
                            <div id="results"  ></div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <h3 class="singin-text mb-3">Kayıt ol</h3>

                    <form method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="İsim" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" name="surname" placeholder="Soyisim" class="form-control <?php echo (!empty($surname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $surname; ?>">
                            <span class="invalid-feedback"><?php echo $surname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="E-mail" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" >
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Şifre" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Şifre Doğrula" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form_group">
                            <input type="hidden" id="base64img" name="base64ImgPHP">
                            <button class="btn btn-class" type="submit" name="submit">Kayıt ol</button>
                            <p>Zaten bir hesabın mı var? <a href="index.php">Giriş</a>.</p>
                        </div>
                    </form><hr/>
                    <span class="<?php echo (!empty($base64ImgPHP_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $base64ImgPHP; ?>"></span>
                    <span class="invalid-feedback"><?php echo $base64ImgPHP_err; ?></span><br/>
                    <button class="btn btn-class" type="submit" onClick="take_snapshot()">Fotoğraf Çek</button>


                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script type="text/javascript" src="webcamjs/webcam.min.js"></script>
<script>

   // Configure a few settings and attach camera

   Webcam.set({
				width: 320,
				height: 240,
				image_format: 'jpeg',
				jpeg_quality: 90
			});
			Webcam.attach( '#my_camera' );


		// preload shutter audio clip


		function take_snapshot() {

			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page
				document.getElementById('results').innerHTML =
					'<img id="imageprev" src="'+data_uri+'" name="imageData"/>';
			} );
            saveSnap();

			//Webcam.reset();
		}

		function saveSnap(){
			// Get base64 value from <img id='imageprev'> source
			var base64image =  document.getElementById("imageprev").src;

			 //Webcam.upload( base64image, 'components/upload.php', function(code, text) {
            Webcam.upload( base64image, 'imageUpload.php', function(code, text) {
				 //console.log('Save successfully');
				 console.log(text);
                 document.getElementById("base64img").value = text;
            });

		}
    </script>
