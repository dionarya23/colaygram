<?php require_once 'core/init.php';
if (!Session::exists('username')){
  header('Location:index.php');
}

require_once 'theme/header.php';
?>
<?php
if( isset($_GET['submit']) ){

$query  = strip_tags(trim( Input::get('search') ));
$result = $user->query_pencarian($query);
  ?>
  <div class="w3-col m8">
    <?php while( $info = $result->fetch_assoc() ){
      $nama     = $info['nama'];
      $username = $info['username'];
      $bio      = $info['tentang'];
      $foto     = $info['foto'];
      $email    = $info['email'];
      $pass     = $info['password'];
      $id       = $info['id'];
      ?>
    <!-- Profile --><br>
    <div class="w3-card-2 w3-round w3-white">
      <div class="w3-container">
       <h4 class="w3-center"><?php echo $nama;?></h4>
       <p class="w3-center"><img src="ajax/user/<?php echo $foto; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
       <hr>
       <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><?php echo $nama;?></p>
       <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?php echo $username;?></p>
       <p><i class="fa fa-paper-plane-o fa-fw w3-margin-right w3-text-theme"></i> <?php echo $bio;?></p>
       <?php
       if (Session::get('username')  === $username){ ?>
       <p style="text-align: center;"><a href="editprofile.php" class="w3-btn w3-teal">Edit Profile</a></p>
     </div>
   </div>
       <?php }
     }?>
  <!-- End Left Column -->
  </div>
<?php
} ?>

<!-- Footer -->
</div>
<br>
<?php require_once 'theme/footer.php'; ?>
