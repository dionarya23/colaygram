<?php
spl_autoload_register(function($class){
  require_once '../classes/'.$class.'.php';
});
$user = new User();
$waktu = new Waktu();
if(is_array($_FILES)){
if(is_uploaded_file($_FILES['gambar']['tmp_name'])){
  $time = time();
  $erroimg    = $_FILES['gambar']['error'];
  $typegambar = $_FILES['gambar']['type'];
  $sizegambar = $_FILES['gambar']['size'];
  $asalpath   = $_FILES['gambar']['tmp_name'];
  $namagambar = $_FILES['gambar']['name'];
if(Input::get('status') === ""){
  echo "<script>alert('status anda tidak boleh kosong')</script>";
}else{

if ($erroimg == 0){
  if($sizegambar < 3000000){
    if ($typegambar == "image/jpg" || $typegambar == "image/png" || $typegambar == "image/gif" || $typegambar == "image/jpeg" ){
      $namagambar = $_FILES['gambar']['name'];
      $ekstensi = substr($typegambar,6);
      $ekstensi = ".".$ekstensi;
      $namagambar = str_replace($ekstensi, "", $namagambar);
      $namagambar = $namagambar."_".$time.$ekstensi;
      $targetpath = "user/".$namagambar;
    move_uploaded_file($asalpath, $targetpath);
      if ($user->status_in(array(
        'status' => Input::get('status'),
        'id_users'=> Input::get('id'),
        'gambar' => $namagambar,
        'jumlah' => 0
      ))){
        $row = $user->statusnya_out();
        $now      = new DateTime();
        $content  = new DateTime( $row['waktu'] );
        $interval = $content->diff($now);
        do { ?>
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
      <?php  } while (1 > 10);

      }else {
      echo "gagal memasukan data";
      }
    }else{
      echo "<script>aler('photo harus jpg atau gif atau png');</script>";
    }
  }else{
    echo "<script>aler('Photo Tidak Boleh lebih besar dari 3Mb');</script>";
  }
}else{
  echo "<script>aler('photo anda bermasalah tidak bisa di upload');</script>";
}
}
}
}

 ?>
