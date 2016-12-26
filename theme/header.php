<!DOCTYPE html>
<html>
<title>ColayGram | Social Media Para Jomblo</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/w3css.css">
<link rel="stylesheet" href="assets/w3themeblue.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<style>
#image-preview {
  width: 200px;
  height: 200px;
  position: relative;
  overflow: hidden;
  background-color: #ffffff;
  color: #ecf0f1;
}
#image-preview input {
  line-height: 200px;
  font-size: 200px;
  position: absolute;
  opacity: 0;
  z-index: 10;
}
#image-preview label {
  position: absolute;
  z-index: 5;
  opacity: 0.8;
  cursor: pointer;
  background-color: #bdc3c7;
  width: 200px;
  height: 50px;
  font-size: 20px;
  line-height: 50px;
  text-transform: uppercase;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  text-align: center;
}
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
<script>

  function komen_muncul(komen){
    $('#'+komen).slideToggle();
  }

function untuk_like(idnya, likenya, status_id){
    var total_lama = parseInt(document.getElementById(idnya).value);
    var total = total_lama+1;
    var id_status = parseInt( document.getElementById(status_id).value );
    $.ajax({
      method : "POST",
      url    : "ajax/like.php",
      data   : {jumlah:total, id:id_status},
      success : function(data){
        document.getElementById(idnya).value = data;
        document.getElementById(likenya).innerHTML = data;
      }
    });
}
</script>

<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <ul class="w3-navbar w3-teal w3-left-align w3-large">
  <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
    <a class="w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  </li>
  <li><a href="#" class="w3-padding-large w3-teal"><i class="fa fa-home w3-margin-right"></i>ColayGram</a></li>
<form action="cari.php" method="get">
  <li class="w3-hide-small">
    <input type="text" name="search" class="w3-input" placeholder="Cari Sesuatu Disini" name="cari"><li>
    <li class="w3-hide-small">
    <input type="submit" name="submit" class="w3-btn w3-primary" value="Cari"></li>
  </form>
    <?php if (!Session::exists('username')){ ?>
      <li class="w3-hide-small"><a href="index.php" class="w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i> Ayo Bergabung</a></li>
      <?php }else{ ?>
      <li class="w3-hide-small"><a href="beranda.php" class="w3-padding-large w3-hover-white" title="News">Beranda</a></li>
      <li class="w3-hide-small"><a href="user.php?user=<?= Session::get('username');?>" class="w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i> Profile</a></li>
      <li class="w3-hide-small w3-right"><a href="logout.php" class="w3-padding-large w3-hover-white" title="My Account">Keluar</a></li>
      <?php  } ?>
 </ul>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:51px">
  <ul class="w3-navbar w3-left-align w3-large w3-theme">
    <?php if(!Session::exists('username')){ ?>
      <li><a class="w3-padding-large" href="index.php">Ayo Bergabung</a></li>
    <?php }else{ ?>
    <li><a class="w3-padding-large" href="beranda.php">Beranda</a></li>
    <li><a class="w3-padding-large" href="user.php?user=<?= Session::get('username');?>">Profile</a></li>
    <li><a class="w3-padding-large" href="logout.php">Keluar</a></li>
    <?php } ?>
  </ul>
</div>
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
