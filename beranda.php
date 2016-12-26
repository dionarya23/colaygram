<?php require_once 'core/init.php';
if (!Session::exists('username')){
  header('Location: index.php');
}
$info = $user->get_profile(Session::get('username'));
$nama     = $info[0];
$username = $info[1];
$bio      = $info[2];
$foto     = $info[3];
$email    = $info[4];
$pass     = $info[5];
$id       = $info[6];
 ?>
<?php require_once 'theme/header.php'; ?>
    <div class="w3-col m2">

      <div class="w3-card-2 w3-round w3-white">

      </div>


      <div class="w3-container w3-round w3-margin-bottom w3-hide-small">

      </div>
      <div id="untuk">
      </div>
    <!-- End Left Column -->
    </div>
<div class="w3-col m8">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <div class="w3-container w3-teal">
          <h6 class="w3-opacity">Update Status</h6>
        </div>
        <form id="form" enctype="multipart/form-data">
          <div id="image-preview">
  <label for="image-upload" id="image-label">Upload Photo</label>
  <input type="file" name="gambar" id="image-upload" accept="image/*" />
          </div>
          <input type="hidden" name="id" value="<?=$id;?>">
          <textarea class="w3-input" id="isi" placeholder="Apa Yang Tidak Anda Pikirkan ?. Perhatian Kalau mau update Status Harus Pakai Gambar!!" name="status"></textarea><br>.
          <input type="submit" id="post" class="w3-btn w3-teal" value="Update Status">
        </form>
        </div>
      </div>
    </div>
  </div>
  <div id="status_nya">
<?php
$statuss = $user->status_out();
foreach( $statuss as $row){
  $now = new DateTime();
  $content = new DateTime( $row['waktu'] );
  $interval = $content->diff($now);
 ?>

  <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
    <img src="ajax/user/<?=$row['foto'];?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
    <span class="w3-right w3-opacity"><?php echo $waktu->checkPerbedaan($interval). 'yang lalu'; ?></span>
    <a style="text-decoration:none;" href="user.php?user=<?php echo $row['username'];?>"><h4><?php echo $row['nama'];?></h4></a><br>
    <hr class="w3-clear">
    <p><?php echo Parsedown::instance()->setBreaksEnabled(true)->setUrlsLinked(true)->text($row['status']); ?></p>
      <div class="w3-row-padding" style="margin:0 -16px">
        <div class="">
          <center><img src="ajax/user/<?php echo $row['gambar'];?>" style="width:70%" alt="" class="w3-margin-bottom"></center>
        </div>
    </div>
    <button type="button" class="w3-btn w3-teal w3-margin-bottom" onclick="untuk_like('jumlahnya<?=$row['id'];?>', 'likenya<?=$row['id'];?>', 'id_status<?=$row['id'];?>')"><i class="fa fa-thumbs-up"></i>
      <?php if ($row['jumlah'] > 0){ ?>  <i id="likenya<?=$row['id'];?>"> <?=$row['jumlah'];?></i> <input id="jumlahnya<?=$row['id'];?>" type="hidden" value="<?=$row['jumlah'];?>">
      <?php }else{ echo '<i id="likenya'.$row['id'].'"></i><input id="jumlahnya'.$row['id'].'" type="hidden" value="'.$row['jumlah'].'">'; } ?>
       Like</button>
    <button type="button" onclick="komen_muncul('isi_komennya<?php echo $row['id'];?>')" class="w3-btn w3-teal w3-margin-bottom"><i class="fa fa-comment"></i> <input type="hidden" id="id_status<?=$row['id'];?>" value="<?php echo $row['id']; ?>"> Comment</button>
    <div id="isi_komennya<?php echo $row['id'];?>" style="display:none;">
        <div class="w3-responsive">
          <table class="w3-table" id="komen_muncul<?php echo $row['id'];?>">
            <?php $komentars = $user->keluar_komen_home($row['id']);
             foreach($komentars as $komentar) { ?>
            <tr>
              <td><a href="user.php?user=<?php echo $komentar['username'];?>" style="color:#009688"><?php echo $komentar['username'];?></a><br><?php echo $komentar['isi_komen'];?><hr></td>
            </tr>
            <?php } ?>
          </table>
          </div>
      <input type="text" style="border-style:none" name="komennya" class="w3-input" placeholder="Isi Komentar" id="isi_komen<?php echo $row['id'];?>">
      <button onclick="komen('isi_komen<?php echo $row['id'];?>', <?=$row['id'];?>, <?php echo $id;?>, 'komen_muncul<?php echo $row['id'];?>')" class="w3-btn w3-teal">Kirim</button>
    </div>
    </div>
  <?php
} ?>
  </div>
  <div id="bukan">
  </div>
  <div class="w3-card-4">

<div class="w3-container">
  <a id="<?php echo $row['id'];?>" href="#bukan" class="load_more"><p>Berita Lainnya... <img src="https://www.codepolitan.com/uploads/image/source/20915/arrow1.png" ></p></a>
</div>

</div>
<br>
<!-- End Middle Column -->
</div>
<div class="w3-col m2">
<!-- Untuk DIkiri Ya Coy -->
  <div class="w3-card-2 w3-round w3-white">
  </div>

<!-- End Left Column -->
</div>


<?php  require_once 'theme/footer.php'; ?>
