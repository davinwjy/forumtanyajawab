<?php
include "session.php";
if(isset($login_session)){
?>
<script type="text/javascript">
  function Redirect(){  
        window.location="index.php"; 
  } 
    setTimeout('Redirect()', 100);  
</script>
<?php 
} else {
?>
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
    z-index: -1; /* Ensure div tag stays behind content; -999 might work, too. */
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
      <li><a href="faq.php">FAQ & Rules</a></li>
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
if(isset($login_session)){
?>
  <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo "$login_session" ?></a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> 
      Logout</a></li>
  </ul>
<?php
}else{ 
?>
  <ul class="nav navbar-nav navbar-right">
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Registrasi</a></li>
      <li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
  </ul>
<?php
}
?>
    </div>
</nav>
  
<div class="container" style="padding-top: 80px;">
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-6">
      <div>
      <h3><font color="white">Halaman Login</font></h3>
      </div>
      <br>
    </div>  
    <div class="col-sm-3"></div>
  </div>
<form action="#" method="POST">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="username" type="text" class="form-control" name="username" placeholder="Username" required>
            </div> 
        </div>
        <div class="col-sm-3"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
            </div> 
        </div>
        <div class="col-sm-3"></div>
    </div>   
    <br>
    <div>
        <div class="row">
          <div class="col-sm-5"></div>
          <div class="col-sm-1">
             <button type="reset" class="btn btn-danger" value="Reset">Reset</button>
          </div>
          <div class="col-sm-2">
             <button type="submit" class="btn btn-info" value="Submit">Login</button>
          </div>
          <div class="col-sm-4"></div>
        </div>
    </div>
    </div>
</div>
</form>

<div style=" padding-top:50px;">
<div class="footer" style="background-color: #F8F8F8;padding-top: 5px;">
  <h5 style="color: black;">
    Email : davinwijaya16@gmail.com<br>
    Davin Wijaya @STMIK Widya Dharma 2018<br>
  </h5>
</div>
</div>
  
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
include "koneksi.php";
  $username=$_POST['username'];
  $password=$_POST['password'];

  $hashpass=password_hash($password,PASSWORD_DEFAULT);
  $sql = "select * from tb_user where username='$username'";
  $mysqli1=mysqli_query($mysqli,$sql);
  $row = mysqli_fetch_array($mysqli1,MYSQLI_ASSOC);
  if(password_verify($password, $row["password"])){
    $_SESSION['login_user'] = $username;
    $sql1="insert into tb_login (username) values ('$username')";
    $mysqli2=mysqli_query($mysqli,$sql1);
    $sql2="select id from tb_login ORDER BY ID DESC LIMIT 1 ";
    $mysqli3=mysqli_query($mysqli,$sql2);
    $mysqli4=mysqli_fetch_assoc($mysqli3);
    $_SESSION['idlogin']=$mysqli4['id'];
?>
<script type="text/javascript">
  function Redirect(){  
        // window.location="index.php"; 
        window.history.go(-2);
  } 
    swal("Login Berhasil!", "", "success")
    .then((value) => {
    setTimeout('Redirect()', 100);  
    });
</script>
<?php
  }else{
?>
<script type="text/javascript">
  swal("Login Gagal!", "Username atau Password salah", "error");
</script>
<?php
  }
}
?>
</body>
</html>
<?php
}
?>
