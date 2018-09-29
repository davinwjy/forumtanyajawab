<?php
include "koneksi.php";
include "session.php";

   session_start();   
	if(session_destroy()) {

		$sql1="insert into tb_logout (username,idlogin) values ('$login_session','$id_check')";
		$mysqli2=mysqli_query($mysqli,$sql1);
     	header("Location: login.php");

  	}
?>


