<?php
class Waktu{
  public function checkPerbedaan($time){
    if($time->y > 0)
    return $time->y. ' tahun ';
    if($time->m > 0)
    return $time->m. ' bulan ';
    if($time->d > 0)
    return $time->d. ' hari ';
    if($time->h > 0)
    return $time->h. ' jam ';
    if($time->i > 0)
    return $time->i. ' menit ';
    if($time->s > 0)
    return $time->s. ' detik ';
  }

}

 ?>
