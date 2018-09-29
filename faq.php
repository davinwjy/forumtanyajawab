<!DOCTYPE html>
<html lang="en">
<head>
  <title> - Forum Tanya Jawab - </title>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
</head>
<style type="text/css">
 
  #background {
    width: 100%; 
    height: 100%; 
    position: fixed; 
    left: 0px; 
    top: 0px; 
    z-index: -1; 
  }


  .stretch {
    width:100%;
    height:100%;
  }
  
.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    color: white;
    text-align: center;
}

  .even { background-color:#FFF; }
  .odd { background-color:#f1f1f1;}

</style>
<body>
<div id="background" style="padding-top: 50px;">
    <img src="intro-1600-edit.jpg" class="stretch" alt="" />
</div>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Forum Tanya Jawab</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategori <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <?php
          include "koneksi.php";          
            $sqlmatpel = "select * from tb_matpel";
            $mysqlimatpel=mysqli_query($mysqli,$sqlmatpel);;
            while($row=mysqli_fetch_assoc($mysqlimatpel)){
          ?>
          <li><a href="formmatpel.php?idmatpel=<?php echo $row["id"]; ?>">
            <?php
            echo $row["namamatpel"];
            ?>
          </a></li> 
          <?php
            }
          ?>
        </ul>
      </li>     
      <li class="active"><a href="faq.php">FAQ & Rules</a></li>
    </ul>

    <form class="navbar-form navbar-left" action="search.php" style="padding-left: 360px;" method="GET">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="search" id="search">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>

<?php
include "session.php";
if(isset($login_session)){
$sql="select * from tb_user where username='$login_session'";
$query=mysqli_query($mysqli,$sql);
$fetch=mysqli_fetch_array($query,MYSQLI_ASSOC);
?>
  <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$login_session ?></a>
          <ul class="dropdown-menu">   
            <li><a href="user.php?id=<?php echo $fetch['id']; ?>"> 
              Visitor Message
            </a></li>      
            <li><a href="userthread.php?id=<?php echo $fetch['id']; ?>">
              Forum Thread
            </a></li> 
            <li><a href="usercomment.php?id=<?php echo $fetch["id"]; ?>">
              Forum Comment
            </a></li>           
          </ul>
        </li>
      <li><a href="#" onclick="logout();return false;"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
  </ul>
<?php
}else{ 
?>
  <ul class="nav navbar-nav navbar-right">
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Registrasi</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
  </ul>
<?php
}
?>
    </div>
</nav>

  
<div class="container" style="padding-top: 50px;">  
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-9" style="padding-top: 30px;">
          <table class="table table-bordered">
            <div class="row">
              <div class="col-sm-12">
                    <th colspan="3" style="background-color: #d5ede8;padding: 2px;">
                    <center><h2><b>FAQ & Rules</b></h2></center>   
                          <div align="right" style="padding:5px;">  
                    </th>
              </div>
            </div>         
              
            <tr><td bgcolor="white" style="padding: 50px;font-size: 15px;opacity:0.9;">
              <h3>FAQ</h3><br>
              <div style="padding-left: 20px;">
              Q : Gambar yang diinputkan resolusi terlalu besar dan terpotong. <br>
              A : Klik pada gambar dan akan muncul pilihan ukuran gambar. <br><br>
              Q : Cara ganti avatar <br>
              A : Klik menu yang tersedia di bagian nama username kemudian, klik avatarnya dan akan muncul sebuah box untuk memilih avatar yang tersedia.<br><br>
              </div>
              <h3>Rules</h3><br>
              <ul>  
                  <li>Pastikan pertanyaan yang ingin ditanyakan belum pernah ditanyakan sebelumnya. Gunakan fitur search untuk mencarinya</li><br>
                  <li>Pertanyaan yang ditanyakan harus spesifik agar jawaban yang diberikan berguna dan relevan.</li><br>
                  <li>Pertanyaan yang dipost harus sesuai dengan kategori yang dipilih.</li><br>

              </ul>
            </td></tr>
          </table>
      </div>
      <div class="col-sm-2"></div>
</div>

<!-- 
<div style=" padding-top:80px;">
<div class="footer" style="background-color: #F8F8F8;padding-top: 5px;">
  <h5 style="color:black;">
    Email : davinwijaya16@gmail.com<br>
    Davin Wijaya @STMIK Widya Dharma 2018<br>
  </h5>
</div>
</div> -->
<script type="text/javascript">
  
  function logout(){
    swal("Anda ingin logout?", {
      buttons: {
        cancel: "Cancel",
        okay: true,
      },
    })

  .then((value) => {
  switch (value) {
 
    case "okay":        
      window.location="logout.php"; 
      break;
      
    case "cancel":
      swal.close;
  }
  });
  }
</script>
</body>
</html>