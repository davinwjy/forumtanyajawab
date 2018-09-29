<?php
include "koneksi.php";
$idthread=$_POST['idthread'];
$username=$_POST['user'];
$sql="delete from tb_likethread where idthread='$idthread' and username='$username'";
$query=mysqli_query($mysqli,$sql);

?>