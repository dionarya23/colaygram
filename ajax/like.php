<?php
spl_autoload_register(function($class){
  require_once '../classes/'.$class.'.php';
});
$user = new User();
$datanya = Input::get('jumlah');
$id      = Input::get('id');

if ($user->like_masuk(array(
  'jumlah' => $datanya
), $id) ){
  echo $datanya;
}else{
  echo "gagal coy";
} 



?>
