<?php
// Include connect file
require_once "connect.php";


// Define variables and initialize with empty values
$TC_no = $TC_noerr = $date_of_birth = $date_of_birth_err =  $name = $surname = $email = $password = $confirm_password = $base64ImgPHP = "";
$name_err = $surname_err = $email_err = $password_err = $confirm_password_err = $base64ImgPHP_err = "";

    function karakterDuzelt($yazi){
     $ara=array("ç","i","ı","ğ","ö","ş","ü");
     $degistir=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
     $yazi=str_replace($ara,$degistir,$yazi);
     $yazi=strtoupper($yazi);
     return $yazi;
   }
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $base64ImgPHP = $_POST["base64ImgPHP"];

    //Validate TC
    if(empty(trim($_POST['tcno']))){
        $TC_noerr = "TC kimlik numarası boş bırakılamaz.";
      }else{
        $sql = "SELECT id FROM users WHERE TC_no = ?";
        if($stmt2 = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt2, "s", $param_TC_no);

            // Set parameters
            $param_TC_no = trim($_POST["tcno"]);
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt2)){
                /* store result */
                mysqli_stmt_store_result($stmt2);

                if(mysqli_stmt_num_rows($stmt2) == 1){
                    $TC_noerr = "Bu TC kimlik numarası ile kayıt mevcut.";
                } else{
                    $TC_no = trim($_POST["tcno"]);
                }
            } else{
                echo "Oops! Bi'şeyler ters gitti. Daha sonra tekrar deneyin.";
            }

            // Close statement
            mysqli_stmt_close($stmt2);
        }
    }
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
    //Validate birthday
    if(empty($_POST['birthday'])){
        $date_of_birth_err = "Doğum tarihi boş bırakılamaz.";
    }else{
        $date_of_birth = trim($_POST["birthday"]);
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
      $default_date = date('Y-m-d', strtotime($date_of_birth));

          if (isset($_POST['submit'])) {
            /*
            Değerler, formu gönder butonu ile birlikte POST edildi ve yakalayıp ilgili değiş-
            kenlere atadık.
            */
            $tcKimlikNo=$_POST['tcno'];
              /*
              Ad ve Soyad için türkçe küçük karakter yazılırsa bunu otomatik olarak büyük hale
              çeviriyoruz (karakterDuzeltme) ve her ihtimale karşın sağında ya da solunda
              boşluk varsa o kısmı kırpıyoruz(trim()).
              */
              $ad = karakterDuzelt(trim($_POST["name"]));
              $soyad= karakterDuzelt(trim($_POST['surname']));
              $dogumYili=$_POST['birthday'];
                /*
                Bundan sonraki kodları TRY CATCH blogunda yazdıracağız ki herhangi bir hata ol-
                duğunda bunu yakalayabilelim.
                */
                try {
                /*
                Değişkenlere atadığımız form verilerini $veriler adında bir diziye aktarıyoruz.
                */
                  $veriler = array(
                    'TCKimlikNo' => $tcKimlikNo,
                    'Ad' => $ad,
                    'Soyad' => $soyad,
                    'DogumYili' => $dogumYili
                  );
            /*
            OOP ile SOAP oluşturarak $baglan adında bir değişkene atıyoruz. Bu sayede
            tckimlik.nvi.gov.tr üzerinden elimizdeki verileri kullanarak sorgulama yapabile-
            ceğiz. Eğer php.ini de bulunan extensions'da soap aktif değilse başındaki ";"
            noktalı virgülü kaldırıp servisi yeniden başlatmanız gerekecektir.
            */
            $baglan = new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");
            $sonuc = $baglan -> TCKimlikNoDogrula ($veriler);
                // Forma girilen bilgilerin hepsi doğruysa aşağıdaki mesaj
                if ($sonuc->TCKimlikNoDogrulaResult) {

                }
              // Bir yada bir kaçtanesi yanlış ise aşağıdaki mesaj son kullanıcıya gösterilir.
                else {
                $date_of_birth_err = "Girmiş olduğunuz kimlik bilgileri yanlıştır.";
                }
              // Eğer hata oluşursa ekrana yazdırıyoruz.
              } catch (\Exception $e) {
               echo $e->faultstring;
              }
              }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($surname_err) && empty($email_err) && empty($date_of_birth_err) && empty($TC_noerr) && empty($password_err) && empty($confirm_password_err) && empty($base64ImgPHP_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (TC_no,name,surname,date_of_birth,image,category, email, pass) VALUES ('$TC_no','$name','$surname','$default_date','$base64ImgPHP', '' ,?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);

            // Set parameters
            $param_email = $email;
            $param_password = $password; // Creates a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
              //  header("location: index.php");
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
                          <input type="text" name="tcno" maxlength="11" required="required" placeholder="TC Kimlik No" class="form-control <?php echo (!empty($TC_noerr)) ? 'is-invalid' : ''; ?>" value="<?php echo $TC_no; ?>">
                          <span class="invalid-feedback"><?php echo $TC_noerr; ?></span>
                      </div>
                        <div class="form-group">
                            <input type="text" name="name" placeholder="İsim" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" name="surname" placeholder="Soyisim" class="form-control <?php echo (!empty($surname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $surname; ?>">
                            <span class="invalid-feedback"><?php echo $surname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="date" name="birthday" required="required" placeholder="Doğum Tarihi" class="form-control <?php echo (!empty($date_of_birth_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date_of_birth; ?>">
                            <span class="invalid-feedback"><?php echo $date_of_birth_err; ?></span>
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
