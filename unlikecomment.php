<?php
include "koneksi.php";
$idcomment=$_POST['idcomment'];
$idthread=$_POST['idthread'];
$username=$_POST['user'];
$sql="delete from tb_likecomment where idthread='$idthread' and idcomment='$idcomment' and username='$username'";
$query=mysqli_query($mysqli,$sql);

?>