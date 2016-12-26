<?php
spl_autoload_register(function($class){
  require_once '../classes/'.$class.'.php';
});
$user = new User();
$isi_komen = Input::get('isi_komen');
$id_user   = Input::get('id_user');
$id_status = Input::get('id_status');

$komentar = $user->keluar_komen();

if ( $user->komen_masuk(array(
    'id_users'  => $id_user,
    'id_status' => $id_status,
    'isi_komen' => $isi_komen
)) ){
    do { ?>
      <tr>
        <td><a href="user.php?user=<?php echo $komentar['username'];?>" class="w3-teal"><?php echo $komentar['username'];?></a><br><?php echo $komentar['isi_komen'];?><hr></td>
      </tr>
<?php    } while (1 > 10);
}else{
  echo "gagal memasukan Komentar";
}

 ?>
