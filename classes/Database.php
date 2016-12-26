<?php
class Database{

private static $INSTANCE = null;
private $mysqli,
        $HOST = '127.0.0.1',
        $USER = 'root',
        $PASS = '',
        $DBNAME = 'colaygram';

  public function __construct(){
    $this->mysqli = new mysqli($this->HOST, $this->USER, $this->PASS, $this->DBNAME);
    if (mysqli_connect_error()){
      die("gagal konek ke database");
    }
  }

  //singlepaton mencegah koneksi database yang double
  public static function getInstance(){
    if (!isset(self::$INSTANCE)){
      self::$INSTANCE = new Database();
    }
    return self::$INSTANCE;
  }

//memasukan data ke database untuk pendafataran users
  public function insert($table, $fields = array()){
    $column = implode(", ", array_keys($fields));
    $valueArrays = array();
    $i = 0;
    foreach($fields as $key=>$values){
      if (is_int($values)){
        $valueArrays[$i] = $this->escape($values);
      }else{
        $valueArrays[$i] = "'". $this->escape($values) ."'";
      }
      $i++;
    }
    $values = implode(", ", $valueArrays);
    $query  = "INSERT INTO $table ($column) VALUES ($values)";
    return $this->run_query($query);
  }

//mengupdate info user
  public function update($table, $fields = array(), $id){
    $valueArrays = array();
    $i = 0;

    foreach($fields as $key=>$values){
      if ( is_int($values) ){
        $valueArrays[$i] = $key. "=" . $this->escape($values);
      }else {
        $valueArrays[$i] = $key. "='".$this->escape($values)."'";
      }
      $i++;
    }

    $values = implode(", ", $valueArrays);
    $query  = "UPDATE $table SET $values WHERE id=$id";
    return $this->run_query($query);
  }

  //mengambil info user
  public function get_info($table, $column, $value){
    if(!is_int($value)){
      $value = "'".$this->escape($value)."'";
      }

      $query  = "SELECT * FROM $table WHERE $column = $value";
      $result = $this->mysqli->query($query);
      while ( $row = $result->fetch_assoc() ) {
        return $row;
      }
  }
  //mengambil status per user
  public function get_statusperuser($id){
    $query  = "SELECT users.foto, status.jumlah, status.id, status.status, users.username, users.nama, status.gambar FROM users INNER JOIN status ON users.id = status.id_users AND users.id=$id ORDER BY status.id DESC";
    $result = $this->mysqli->query($query);
    return $result;
  }

//mengambil status nya user dari php langsung
  public function get_status(){
    $query  = "SELECT users.foto, status.waktu, status.jumlah, status.id, status.status, users.username, users.nama, status.gambar FROM users INNER JOIN status ON users.id = status.id_users ORDER BY status.id DESC LIMIT 5";
    $result = $this->mysqli->query($query);
    return $result;
  }

  //mengambil status user dari javascript
  public function get_statusnya(){
    $query  = "SELECT users.foto, status.waktu, status.jumlah, status.id, status.status, users.username, users.nama, status.gambar FROM users INNER JOIN status ON users.id = status.id_users ORDER BY status.id DESC";
    $result = $this->mysqli->query($query);
    while ($row = $result->fetch_assoc() ) {
      return $row;
    }
  }

  public function komen_beranda($id){
  $query = "SELECT users.username, komentar.isi_komen FROM komentar INNER Join users INNER JOIN status ON users.id = komentar.id_users AND komentar.id_status = status.id AND status.id=$id ORDER BY komentar.id ASC";
  $result = $this->mysqli->query($query);
    return $result;
  }

  //mengambil komentar dari user
  public function komen_keluar(){
  $query = "SELECT users.username, komentar.isi_komen FROM komentar INNER Join users INNER JOIN status ON users.id = komentar.id_users AND komentar.id_status = status.id ORDER BY komentar.id ASC";
  $result = $this->mysqli->query($query);
  while ( $row = $result->fetch_assoc() ){
    return $row;
  }
  }

//pencarian query
  public function pencarian($key){
    $key = $this->escape($key);
    $query = "SELECT * FROM users WHERE username LIKE '%$key%'";
    $result = $this->mysqli->query($query);
    return $result;
  }

//mengambil status dengan pagination
  public function pagination($idakhir){
    $idakhir = $this->escape($idakhir);
    $query   = "SELECT users.foto, status.waktu, status.jumlah, status.id, status.status, users.username, users.nama, status.gambar FROM users INNER JOIN status ON users.id = status.id_users AND status.id < $idakhir ORDER BY status.id DESC LIMIT 5";
    $result  = $this->mysqli->query($query);
    return $result;
  }

  //menjalankan query
  public function run_query($query){
    if ($this->mysqli->query($query)){
       return true;
    }else{
       return false;
    }
  }

  //untuk escape string
  public function escape($name){
    return $this->mysqli->real_escape_string( strip_tags(htmlentities(($name))));
  }

}
 ?>
