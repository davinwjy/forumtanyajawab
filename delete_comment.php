<!DOCTYPE html>
<html>
<head>
  <title> - Forum Tanya Jawab - </title>
</head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="assets/css/all.css" rel="stylesheet">
    <link href="dist/summernote.css" rel="stylesheet">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script src="dist/summernote.js"></script>
<!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

  <style type="text/css">
  #background {
    width: 100%; 
    height: 100%; 
    position: fixed; 
    left: 0px; 
    top: 0px; 
    z-index: -1; /* Ensure div tag stays behind content; -999 might work, too. */
  }

  .stretch {
    width:100%;
    height:100%;
  }
  </style>
</head>
<body>
<div id="background">
    <img src="intro-1600-edit.jpg" class="stretch" alt="" />
</div>
<?php
include "koneksi.php";
$id=$_GET['id'];
$sql="delete from tb_comment where id='$id'";
$sql1="delete from tb_likecomment where idcomment='$id'";
$query1=mysqli_query($mysqli,$sql1);
    if ($query=mysqli_query($mysqli,$sql)){
?>
    <script type="text/javascript">
      function Redirect(){
        window.history.go(-1);
        // window.location="user.php?id=<?php echo $_GET['id']; ?>";
      } 
      swal("Komentar Berhasil Dihapus!", "", "success")
        .then((value) => {
        setTimeout('Redirect()', 100);  
        });
    </script>
<?php       
}
  mysqli_close($mysqli);
?>