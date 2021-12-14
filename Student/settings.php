<?php
   
    include_once 'sidebar.php';
    include_once '../connect.php';
    $id=$_SESSION["id"];

    $old_pass = $new_pass = $old_pass_err = $new_pass_err = "";

    if(isset($_POST["edit"])){
        if(empty(trim($_POST["old_password"]))){
            $old_pass_err = "Eski şifre alanı boş bırakılamaz.";
        } else{
            $old_pass = trim($_POST["old_password"]);
        }

        $sql = "SELECT pass FROM users WHERE id = $_POST[id2]";
        $result = mysqli_query($link,$sql);
        $fetch_result = mysqli_fetch_array($result);
        $hashed_pass = $fetch_result['pass'];
        $verify = password_verify($old_pass,$hashed_pass);
        if($verify){

            if(empty(trim($_POST["password"]))){
                $new_pass_err = "Şifre alanı boş bırakılamaz.";
            }else{
                $new_password = trim($_POST["password"]);
                $param_password = password_hash($new_password,PASSWORD_DEFAULT);
                $sql2 = "UPDATE users SET pass = '$param_password' WHERE id = $_POST[id2]";
                $result2 = mysqli_query($link,$sql2);
                echo "<script>alert('Şifreniz başarıyla güncellenmiştir.');</script>";
                $link ->close();
                
            }
        }else{
            $old_pass_err = "Eski uyuşmuyor.";
        }
   
      
    }

?>
  <!--Content-->
  <div class="content">
    <section> 
    
        <h2>Ayarlar</h2>
        <div class="container">
        <form class="needs-validation" novalidate method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
               <div class="form-group">
                    <label>Eski Şifre</label>
                    <input type="password" name="old_password" placeholder="Eski Şifre" class="form-control <?php echo (!empty($old_pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $old_pass; ?>"></input>
                    <span class="invalid-feedback"><?php echo $old_pass_err; ?></span>
                </div>

                <div class="form-group">
                    <label>Yeni Şifre</label>
                    <input type="password" name="password" placeholder="Yeni Şifre" class="form-control <?php echo (!empty($new_pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_pass; ?>"></input>
                    <span class="invalid-feedback"><?php echo $new_pass_err; ?></span>
                </div>
                <input type="hidden" name="id2" value="<?php echo $id;?>"></input>
                <div class="form-group">
                    <button type="submit" name="edit" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
        
    </section>
</div>