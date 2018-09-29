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
<body>
<div id="background">
    <img src="intro-1600-edit.jpg" class="stretch" alt="" />
</div>
<?php
  include "koneksi.php";
  $iduser1=$_GET['id'];
  $avatar=$_POST['avatar'];
  $sql3="update tb_user set avatar = '$avatar' where id='$iduser1'";

    if ($query1=mysqli_query($mysqli,$sql3)){
?>
    <script type="text/javascript">
      function Redirect(){
        window.history.go(-2);
        // window.location="user.php?id=<?php echo $_GET['id']; ?>";
      } 
      swal("Avatar Berhasil Diganti!", "", "success")
        .then((value) => {
        setTimeout('Redirect()', 100);  
        });
    </script>
<?php       
}
  mysqli_close($mysqli);
?>
</body>
</html>




