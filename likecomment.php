<?php
include "koneksi.php";
$idcomment=$_POST['idcomment'];
$idthread=$_POST['idthread'];
$username=$_POST['user'];
$sql="insert into tb_likecomment (idthread,idcomment,username) values ('$idthread','$idcomment','$username')";
$query=mysqli_query($mysqli,$sql);

?>