<?php require_once 'core/init.php'; ?>
<?php
$hack = strip_tags( trim( Input::get('user') ) );
if ( $hack ){
 $info = $user->get_profile($hack);
 $nama     = $info[0];
 $username = $info[1];
 $bio      = $info[2];
 $foto     = $info[3];
 $email    = $info[4];
 $pass     = $info[5];
 $id       = $info[6];

 ?>
<?php require 'theme/header.php'; ?>

<!-- Page Container -->
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
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
         <?php } ?>
        </div>
      </div>

      <!-- Alert Box -->
      <div class="w3-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">

      </div>

    <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <div class="w3-col m9">
      <div class="w3-row-padding">
      <?php
      $statuss = $user->status_user($id);
      foreach( $statuss as $row){
       ?>
     <div class="w3-third w3-container w3-margin-bottom">
       <img src="ajax/user/<?php echo $row['gambar'];?>" alt="<?php echo $row['status'];?>" style="width:100%" class="w3-hover-opacity">
       <div class="w3-container w3-white">
         <p><b><?php echo $row['nama'];?></b></p>
         <p><?php echo Parsedown::instance()->setBreaksEnabled(true)->setUrlsLinked(true)->text($row['status']);?></p>
       </div>
     </div>
        <?php
      } ?>
      </div>
    <!-- End Middle Column -->
    </div>

<script> document.title = '<?php echo $nama;?> | Colaygram'; </script>
<?php require_once 'theme/footer.php'; ?>
<br>
<?php } ?>
