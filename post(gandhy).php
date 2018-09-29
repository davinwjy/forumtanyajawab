<?php
include "session.php";
$username=$login_session;
$data = file_get_contents('php://input');
$data = json_decode($data);
// print_r($data);

include "koneksi.php";
  $judul=$data->judul;
  $isi=$data->isi;
  $idmatpel=$data->kategori;
  $sql = "insert into tb_thread (judul,idmatpel,isi,username) values ('$judul','$idmatpel','$isi','$username')";
  $mysqli1=mysqli_query($mysqli,$sql);  
  echo mysqli_insert_id($mysqli);  
?>
