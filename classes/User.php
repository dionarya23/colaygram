<?php
class User{
  private $_db;

  public function __construct(){
    $this->_db = Database::getInstance();
  }

//untuk pendaftaran users
  public function register_user($fields = array()){
    if ($this->_db->insert('users', $fields)) return true;
    else return false;
  }

//untuk login user
  public function login_user($username, $password){
    $data = $this->_db->get_info('users', 'username', $username);
    if ( password_verify($password, $data['password']) ) return true;
    else return false;
  }

//mengecek username untuk login
  public function check_username($username){
    $data = $this->_db->get_info('users', 'username', $username);
    if (empty($data)) return false;
    else return true;
  }

  //mengecek email sudah terdaftar apa Belum
  public function check_email($email){
    $data = $this->_db->get_info('users', 'email', $email);
    if ( empty($data) ) return false;
    else return true;
  }

  public function profile($username){
    $data = $this->_db->get_info('users', 'username', $username);
    return $data;
  }

//untuk menampilkan data data dari users
  public function get_profile($objek){
    $profile  = $this->profile($objek);
    $username = $profile['username'];
    $bio      = $profile['tentang'];
    $foto     = $profile['foto'];
    $email    = $profile['email'];
    $nama     = $profile['nama'];
    $pass     = $profile['password'];
    $id       = $profile['id'];

     $info = array($nama, $username, $bio, $foto, $email, $pass, $id);
     return $info;
  }

//mengupdate data data dari user

  public function update_user($fields = array(), $id){
    if ( $this->_db->update('users', $fields, $id) ) return true;
    return false;
  }

  public function status_in($fields = array()){
    if ($this->_db->insert('status', $fields)) return true;
    else return false;
  }

  //mambah jumlah like nya
  public function like_masuk($fields = array(), $id){
    if ($this->_db->update('status', $fields, $id)) return true;
    else return false;
  }

  public function status_out(){
  $datanya = $this->_db->get_status();
    return $datanya;
  }

  public function statusnya_out(){
  $datanya = $this->_db->get_statusnya();
    return $datanya;
  }

//mengambil status per user
  public function status_user($id){
    $datanya = $this->_db->get_statusperuser($id);
      return $datanya;
  }

  //memasukan komentar
  public function komen_masuk($fields = array()){
    if ($this->_db->insert('komentar', $fields)) return true;
    else return false;
  }
//mengambil komen dari beranda
  public function keluar_komen_home($id){
    $result = $this->_db->komen_beranda($id);
    return $result;
  }

  //untuk mengeluarkan komentar
  public function keluar_komen(){
    $result = $this->_db->komen_keluar();
    return $result;
  }

  //untuk pencarian
  public function query_pencarian($query){
    $result = $this->_db->pencarian($query);
    return $result;
  }

//mengambil status dengan pagination
  public function pagination($idakhir){
    $result = $this->_db->pagination($idakhir);
    return $result;
  }

}

 ?>
