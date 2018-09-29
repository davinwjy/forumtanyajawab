<?php
include "koneksi.php";
$idthread=$_POST['idthread'];
$username=$_POST['user'];
$sql="insert into tb_likethread (idthread,username) values ('$idthread','$username')";
$query=mysqli_query($mysqli,$sql);

?>