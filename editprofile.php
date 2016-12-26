<?php require_once 'core/init.php';
$pesan_flash = '';
$info = $user->get_profile(Session::get('username'));
$nama     = $info[0];
$username = $info[1];
$bio      = $info[2];
$foto     = $info[3];
$email    = $info[4];
$pass     = $info[5];
$id       = $info[6];
if (!Session::exists('username')){
  header("Location : index.php");
}elseif (Session::get('username') != $username) {
  header( 'user.php?user='.$username.'' );
}elseif (Input::get('update_pass')) {
  $validation = new Validation();
  $validation = $validation->check(array(
    'password' => array('required' => true
                        ),
    'pass_new' => array('required' => true,
                        'min' => 6
                      ),
    'pass_baru' => array('required' => true,
                          'match' => 'pass_new'
                        )
  ));
  if ( $validation->passed() ){
    if ( password_verify(Input::get('password'), $pass)){
      $user->update_user(array(
        'password' => password_hash(Input::get('pass_new'), PASSWORD_DEFAULT)
      ), $id);
      $pesan_flash = '<div class="w3-panel w3-teal"><h5>Selamat</h5><strong>Password Anda Berhasil Di Ganti</strong></div>';
    }else{
      $errors[] = "Password Lama Anda Salah";
    }

  }else{
    $errors = $validation->errors();
  }
  //akhir dari input password
}elseif (Input::get('update')) {
    $user->update_user(array(
      'nama' => Input::get('nama'),
      'email' => Input::get('email'),
      'tentang' => Input::get('tentang')
    ), $id);
    $pesan_flash = '<div class="w3-panel w3-teal"><h5>Selamat</h5><strong>Profile Anda Berhasil Di Perbarui</strong></div>';
}elseif(Input::get('update_gambar')){
  $nama_foto  = $_FILES['foto']['name'];
  $size_foto  = $_FILES['foto']['size'];
  $tmp_foto   = $_FILES['foto']['tmp_name'];
  $type_foto  = $_FILES['foto']['type'];
  $error_foto = $_FILES['foto']['error'];

  if ($error_foto == 0) {
  if ($size_foto < 2000000){
    if ($type_foto == 'image/jpeg' || $type_foto == 'image/jpg' || $type_foto == 'image/png' || $type_foto == 'image/gif'){
      move_uploaded_file($tmp_foto, 'user/'.$nama_foto);
      $user->update_user(array('foto' => $nama_foto), $id);
      $pesan_flash = '<div class="w3-panel w3-teal"><h5>Selamat</h5><strong>Foto anda Berhasil di Perbarui </strong></div>';
    }else{
      $pesan_flash = '<div class="w3-panel w3-red"><h5>Maaf</h5><strong>Foto Harus Ukurang jpeg, jpg, png, gif</strong></div>';
    }

    }else{
      $pesan_flash = '<div class="w3-panel w3-red"><h5>Maaf</h5><strong>Ukuran Foto Tidak Boleh Lebih Besar Dari 2MB</strong></div>';
  }

  }else{
    $pesan_flash = '<div class="w3-panel w3-red"><h5>Maaf</h5><strong>Maaf foto anda, error silahkan gunakan yang lain</strong></div>';
}
}
if (Session::exists('profile')){
  $pesan_flash = Session::flash('profile');
}
 ?>
<?php require_once 'theme/header.php'; ?>
<!-- Page Container -->
    <!-- Left Column -->
    <?php


     ?>
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"><?=$nama;?></h4>
         <p class="w3-center"><img src="user/<?php echo $foto; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><?=$nama;?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?=$username;?></p>
         <p><i class="fa fa-paper-plane-o fa-fw w3-margin-right w3-text-theme"></i> <?=$bio;?></p>
        </div>
      </div>

      <!-- Alert Box --><br>
      <br>
      <div class="w3-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <form action="" method="post" enctype="multipart/form-data">
          <label for="foto">Perbarui Gambar</label>
          <input type="file" name="foto">
          <input type="submit" name="update_gambar" value="Upload" class="w3-btn w3-teal">
        </form>
      </div>
    <!-- End Left Column -->
    </div>
    <!-- Middle Column -->
    <div class="w3-col m7">
      <?php echo $pesan_flash; ?>
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card-2 w3-round w3-white">
            <div class="w3-container w3-padding">
              <div class="w3-container w3-teal">
              <h6 class="w3-opacity">Update Profile Mu</h6>
            </div>
            <form action="" method="post">
            <label for="nama" class="w3-label">Nama :</label>
            <input type="text" name="nama" class="w3-input" placeholder="Nama Lengkap" id="d" value="<?=$nama;?>" required><br>

            <label for="username" class="w3-label">Username :</label>
            <input type="text" name="username" class="w3-input" placeholder="Username" value="<?=$username;?>" disabled><br>

            <label for="email" class="w3-label">Email :</label>
            <input type="email" name="email" class="w3-input" placeholder="Email" value="<?=$email;?>" required><br>

            <label for="tentang">Bio Anda :</label>
            <input type="text" name="tentang" class="w3-input" value="<?=$bio;?>" required><br>
            <input type="submit" name="update" value="Update" class="w3-btn w3-teal">
          </form>
            </div>
          </div>
        </div>
      </div>

    <!-- End Middle Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card-2 w3-round w3-white w3-center">
        <div class="w3-container w3-teal">
        <h6 class="w3-opacity">Perbarui Password</h6>
      </div>
      <form action="" method="post">
      <label for="nama" class="w3-label">Password Lama :</label>
      <input type="password" name="password" class="w3-input" placeholder="Password lama" required><br>

      <label for="username" class="w3-label">Password Baru :</label>
      <input type="password" name="pass_new" class="w3-input" placeholder="Password Baru" required><br>

      <label for="username" class="w3-label">Ulangi Password Baru :</label>
      <input type="password" name="pass_baru" class="w3-input" placeholder="Ulangi Lagi" required><br>

      <input type="submit" name="update_pass" value="Update Password" class="w3-btn w3-teal"><br>
    </form>
      </div>
      <br>

      <div class="w3-card-2 w3-round w3-white w3-center">
        <?php if(!empty($errors)){ ?>
    		<div class="alert alert-danger"> <h5>Perhatian !!</h5>
    		<?php foreach($errors as $error){ ?>
    			<strong><li><?php echo $error;?></li></strong>
    				<?php } ?>
    		</div>
    		<?php } ?>
      </div>
      <br>


      <br>



    <!-- End Right Column -->
    </div>

<?php require_once 'theme/footer.php'; ?>
