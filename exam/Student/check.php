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
          <!--  <button type="submit" name="face" class="btn btn-primary" onClick="take_snapshot()">Fotoğraf Çek</button>
            <div class="form-group mt-5 d-flex">
                <div id="my_camera" class="mr-5"></div>
                <div id="results"></div>
            </div>
        </div> -->

    </section>
</div>



<!-- <script type="text/javascript" src="../webcamjs/webcam.js"></script>
<script>
    //cam
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
        Webcam.upload( base64image, '../imageUpload.php', function(code, text) {
			//console.log('Save successfully');
			console.log(text);
            document.getElementById("base64img").value = text;
        });

	}




(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script> -->
