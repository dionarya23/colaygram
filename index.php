<?php require_once 'core/init.php'; ?>

<?php

$errors = array();
$login_msg = '';
function login_msg($pesan){
	return '<div class="alert alert-danger">'.$pesan.'
	</div>';
}
$validation = new Validation();
if (Input::get('daftar')){
	$validation->check(array(
		'nama' => array(
					'required' => true,
					'min'      => 3,
					'max'      => 50
		),
		'username' => array(
					'required' => true,
					'min'      => 3,
					'max'      => 50
		),
		'email'     => array(
					'required' => true,
		),
		'password'  => array(
					'required' => true,
					'min'      => 6,
					'max'      => 255
		),
		'ulangi_password' => array(
					'required' => true,
					'match'    => 'password'
		)
	));

	if ($user->check_username(Input::get('username'))){
		$errors[] = "Username sudah Terdaftar";
	}elseif ($user->check_email(Input::get('email'))) {
		$errors[] = "Email Sudah Terdaftar";
	}else {
	if ($validation->passed()){
$user->register_user(array(
		'nama'     => Input::get('nama'),
		'username' => Input::get('username'),
		'email'    => Input::get('email'),
		'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
		'tentang'  => Input::get('tentang'),
		'foto'     => Input::get('foto')
	));
	Session::flash('profile', '<div class="w3-panel w3-teal"><h5>Selamat</h5><strong>Anda Berhasil Mendaftar, Silahkan Edit Profile Anda</strong></div>');
	Session::set('username', Input::get('username'));
	header('Location: editprofile.php');;

}else{
	$errors = $validation->errors();
}
}
//untuk login
}elseif (Input::get('masuk')) {
	if ( Token::check( Input::get('token') ) ){
	$validation->check(array(
		'username' => array('required' => true),
		'password' => array('required' => true) ));

	if($validation->passed()){
		if ( $user->check_username(Input::get('username')) ) {
		if( $user->login_user(Input::get('username'), Input::get('password')) ){
			Session::set('username', Input::get('username'));
			   header('Location: user.php?user='.Session::get('username').'');
		}else{
			$login_msg = login_msg("Password Anda Salah");
		}
	}else{
		$login_msg = login_msg("username Salah Atau Belum Terdaftar");
	}
	}else{
		$errors = $validation->errors();
	}
}
}elseif (Session::exists('username')){
	header('Location: beranda.php');
}
 ?>
<!DOCTYPE html>
<html>
<head>
<title>ColayGram | Sosmed Untuk Jomblo</title>

<!-- For-Mobile-Apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Sosial Media, Para Jomblo, Sosial Media Colay Gram" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //For-Mobile-Apps -->

<!-- Custom-Stylesheet-Links -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="assets/css/flexslider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="assets/w3css.css">
<!-- //Custom-Stylesheet-Links -->
<!-- Web-Fonts -->
	<link href='//fonts.googleapis.com/css?family=Hammersmith+One' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Lato:400,700,900,300' rel='stylesheet' type='text/css'>
	<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<script src="assets/js/jquery-1.11.1.min.js"></script>
<!-- //Web-Fonts -->
 <script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/Chart.js"></script>
<!-- //chart -->

<script src="assets/js/easyResponsiveTabs.js" type="text/javascript"></script>
	<script type="text/javascript">
	/*Ini Jquery Jangan Dihapus*/
		$(document).ready(function () {
			$('#horizontalTab').easyResponsiveTabs({
				type: 'default', //Types: default, vertical, accordion
				width: 'auto', //auto or any width like 600px
				fit: true   // 100% fit in a container
			});
		});
	   </script>
<!--JS for animate-->
	<link href="assets/css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="assets/js/wow.min.js"></script>
		<script>
			new WOW().init();
		</script>
	<!--//end-animate-->
</head>
<body>
<!-- Banner -->
	<div class="banner">
		<!-- Header -->
	<div class="header">
		<div class="container">
		<!-- Navbar -->
		<nav class="navbar navbar-default">
			<div class="container-fluid">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand wow fadeInLeft animated" data-wow-delay=".5s" href="#">ColayGram</a>
				</div>

				<div class="navbar-collapse collapse hover-effect wow fadeInRight animated" data-wow-delay=".5s" id="navbar">
					<ul>
						<li><a href="#"><span>Sosmed Untuk</span></a></li>
						<li><a href="#"><span>Para Jomblo</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- //Navbar -->
	</div>
</div>
<div class="container" style="margin-top:80px;">

	<div class="row">
	<div class="col-md-6">
	<div class="w3-card-24">
	    <div class="w3-container w3-teal" style="padding-top:3px;">
	  <h1 style="color:white">Silahkan Masuk</h1>
	</div>
	<div style="background-color:white"><br>
	<form class="w3-card-24 w3-form w3-container" action="" method="post">
		<?php echo $login_msg; ?>
	<label for="username" class="w3-label">Username :</label>
	<input type="text" name="username" class="w3-input" placeholder="Username" required><br>
	<label for="password" class="w3-label">Password :</label>
	<input type="password" name="password" class="w3-input" placeholder="Password" required><br>

	<input type="hidden" name="token" value="<?php echo Token::generate();?>" >
	<input type="submit" name="masuk" value="Masuk" class="btn w3-teal">
	</form>
	</div>
	</div>
	</div>

	<!-- Untuk register_user -->
	<div class="col-md-6">
	<div class="w3-card-24">
	  <div class="w3-container w3-teal" style="padding-top:3px;">
	<h1 style="color:white">Silahkan Daftar</h1>
	<p>Jika Tidak Punya Akun</p>
	</div>
	<div style="background-color:white"><br>
	<form class="w3-card-24 w3-form w3-container" action="" method="post">
		<?php if(!empty($errors)){ ?>
		<div class="alert alert-danger"> <h5>Perhatian !!</h5>
		<?php foreach($errors as $error){ ?>
			<strong><li><?php echo $error;?></li></strong>
				<?php } ?>
		</div>
		<?php } ?>
	<label for="nama" class="w3-label">Nama :</label>
	<input type="text" name="nama" class="w3-input" placeholder="Nama Lengkap" required><br>
	<label for="username" class="w3-label">Username :</label>
	<input type="text" name="username" class="w3-input" placeholder="Username" required><br>
	<label for="email" class="w3-label">Email :</label>
	<input type="email" name="email" class="w3-input" placeholder="Email" required><br>
	<label for="password" class="w3-label">Password :</label>
	<input type="password" name="password" class="w3-input" placeholder="Password" required><br>
	<label for="password" class="w3-label">Ulangi Password :</label>
	<input type="password" name="ulangi_password" class="w3-input" placeholder="Ulangi Password" required><br>
	<input type="hidden" name="tentang" value="Hai Semuanya Saya Menggunakan ColayGram!!!">
	<input type="hidden" name="foto" value="bitch.jpg">
	<input type="submit" name="daftar" value="Daftar" class="btn w3-teal">
	</form>
	</div>
	</div>
	<!-- Akhir Dari Register User -->
	</div>
	</div>
</div>

	</div>
</div>
	</body>
	</html>
