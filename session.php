<?php
   include "koneksi.php";
   session_start();
   if(isset($_SESSION['login_user'])){
   $user_check = $_SESSION['login_user'];
   $id_check= $_SESSION['idlogin'];
   $ses_sql = mysqli_query($mysqli,"select id,username from tb_user where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session="..";
   $login_session = $row['username'];
   $id_session=$row['id'];
   }
   
?>