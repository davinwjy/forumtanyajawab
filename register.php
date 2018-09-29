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
.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    color: white;
    text-align: center;
}

.selected {
    background-color: #ccc;
}

#avatar label {
    display: inline-block;
    cursor: pointer;
}

#avatar label img {
    padding: 3px;
}

.a{
  visibility:hidden;
}

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

input[type=radio] + label {
    
} 

input[type=radio]:checked + label {
  border:3px solid black;
  background-color:#black;
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
      <li><a href="logout.php" ><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
  </ul>
<?php
}else{ 
?>
  <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="register.php"><span class="glyphicon glyphicon-user"></span> Registrasi</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
  </ul>
<?php
}
?>
    </div>
</nav>
  
<form action="#" method="POST">
<div class="container" style="padding-top: 80px;">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
          <div>
          <h3><font color="white">Halaman Register</font></h3>
          </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <br>
    <div class="row" style="padding-bottom: 8px">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
          <div class="input-group">    
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>        
            <input id="username" type="text" class="form-control" name="username" placeholder="Username" maxlength="20" required>
          </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="row" style="padding-bottom: 8px">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
          <div class="input-group"> 
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>           
            <input id="password" type="password" class="form-control" name="password" maxlength="15" placeholder="Password" required>
          </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="row" style="padding-bottom: 8px">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
          <div class="input-group">    
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>        
            <input id="email" type="email" class="form-control" name="email" placeholder="Email" required>
          </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <div class="row" style="padding-bottom: 8px">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
          <div class="input-group">    
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>        
            <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
          </div>
        </div>
        <div class="col-sm-4"></div>
    </div>  <center>
    <h5 style="padding-top: none;"><font color="white"><b>Pilih Avatar</b></font></h5>
    <div class="row" style="padding-top: 5px;">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">   
            <input type="radio" name="avatar" id="mprofile" class="a" value="/avatar/mprofile.png" checked="checked" />
            <label for="mprofile"><img src="<?php $_SERVER['REQUEST_URI']; ?>\avatar\mprofile.png" alt="mprofile" width="80px" height="80px" class="img-circle"/></label>
            <input type="radio" name="avatar" id="fprofile" class="a" value="/avatar/fprofile.png">
            <label for="fprofile"><img src="<?php $_SERVER['REQUEST_URI']; ?>\avatar\fprofile.png" alt="fprofile" width="80px" height="80px" class="img-circle"/></label>


            <input type="radio" name="avatar" id="usertile1" class="a" value="/avatar/usertile1.bmp" />
            <label for="usertile1"><img src="<?php $_SERVER['REQUEST_URI']; ?>\avatar\usertile1.bmp" alt="usertile1" width="80px" height="80px" class="img-circle"/></label>
            <input type="radio" name="avatar" id="usertile2" class="a" value="/avatar/usertile2.bmp" />
            <label for="usertile2"><img src="<?php $_SERVER['REQUEST_URI']; ?>\avatar\usertile2.bmp" alt="usertile2" width="80px" height="80px" class="img-circle"/></label><br><br>
            <input type="radio" name="avatar" id="usertile3" class="a" value="/avatar/usertile3.bmp" />
            <label for="usertile3"><img src="<?php $_SERVER['REQUEST_URI']; ?>\avatar\usertile3.bmp" alt="usertile3" width="80px" height="80px" class="img-circle"/></label>
            <input type="radio" name="avatar" id="usertile4" class="a" value="/avatar/usertile4.bmp" />
            <label for="usertile4"><img src="<?php $_SERVER['REQUEST_URI']; ?>\avatar\usertile4.bmp" alt="usertile4" width="80px" height="80px" class="img-circle"/></label>
            <input type="radio" name="avatar" id="usertile5" class="a" value="/avatar/usertile5.bmp" />
            <label for="usertile5"><img src="<?php $_SERVER['REQUEST_URI']; ?>\avatar\usertile5.bmp" alt="usertile5" width="80px" height="80px" class="img-circle"/></label>
            <input type="radio" name="avatar" id="usertile6" class="a" value="/avatar/usertile6.bmp" />
            <label for="usertile6"><img src="<?php $_SERVER['REQUEST_URI']; ?>\avatar\usertile6.bmp" alt="usertile6" width="80px" height="80px" class="img-circle"/></label>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <br>
    <div class="row">
          <div class="col-sm-5"></div>
          <div class="col-sm-1">
             <button type="reset" class="btn btn-danger" value="Reset">Reset</button>
          </div>
          <div class="col-sm-1">
             <button type="submit" class="btn btn-info" value="Submit">Daftar</button>
          </div>
          <div class="col-sm-5"></div>
    </div>
    </center>
</div>
  </form>
  
<div style="padding-top:80px;">
<div class="footer" style="background-color: #F8F8F8;padding-top: 5px;">
  <h5 style="color:black;">
    Email : davinwijaya16@gmail.com<br>
    Davin Wijaya @STMIK Widya Dharma 2018<br>
  </h5>
</div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){
  include "koneksi.php";
  $username=$_POST['username'];
  $password=$_POST['password'];
  $hashpass=password_hash($password,PASSWORD_DEFAULT);
  $nama=$_POST['nama'];
  $email=$_POST['email'];
  $avatar=$_POST['avatar'];
  $sql1 = "select * from tb_user where username='$username' or email='$email'";
  $mysqli1=mysqli_query($mysqli,$sql1);
  
  if (mysqli_num_rows($mysqli1) >0 ){
    ?>
    <script type="text/javascript">
      swal("Username atau Email sudah terdaftar!"," ","error");
    </script>
<?php
  }else{
  $sql = "INSERT INTO tb_user (username, password, nama , email, avatar)
  VALUES ('$username', '$hashpass', '$nama', '$email', '$avatar')";
    if ($query=mysqli_query($mysqli,$sql)){
        $sqlid="select id from tb_user where username='$username'";
        $queryid=mysqli_query($mysqli,$sqlid);
        $fetchid=mysqli_fetch_array($queryid,MYSQLI_ASSOC);
        $id = $fetchid["id"];
        $directory="./assets/user/$id/";
        mkdir($directory, 0777,true);
?>
?>
<script type="text/javascript">
  function Redirect(){
    window.location="login.php";
  } 
  swal("Registrasi Berhasil!", "Anda akan dipindahkan ke page login", "success")
    .then((value) => {
    setTimeout('Redirect()', 100);  
    });
</script>
  <?php       
    }
  }
  mysqli_close($mysqli);
}
  ?>
</body>
</html>
<?php
}
?>

