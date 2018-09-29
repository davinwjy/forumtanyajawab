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
      <li class="active"><a href="index.php">Home</a></li>
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

  <?php
  include "koneksi.php";
  $sql="select tb_thread.*,tb_matpel.namamatpel,tb_user.id as iduser,tb_matpel.id as idmatpel from tb_thread 
join tb_matpel on tb_thread.idmatpel = tb_matpel.id 
join tb_user on tb_user.username=tb_thread.username
order by tb_thread.created_at desc limit 10";
  $mysqli1=mysqli_query($mysqli,$sql);
  ?> 
  
<div class="container" style="padding-top: 50px;">  
    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8" style="padding-top: 30px;">
          <table class="table table-bordered">
            <div class="row">
              <div class="col-sm-12">
                    <th colspan="3" style="background-color: #bcbfc4;padding: 2px;">
                    <center><h3><b>Thread pertanyaan terbaru</b></h3></center>   
                          <div align="right" style="padding:5px;">  
                          <a href="createpost.php" class="btn btn-primary btn-md" role="button" aria-disabled="true">Tulis Thread</a></div>
                    </th>
              </div>
            </div>            
            <?php
              if(mysqli_num_rows($mysqli1)>0){
              while($row=mysqli_fetch_assoc($mysqli1)){
            ?>
              <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">
                  <td style="font-size: 16px;word-wrap: break-word;max-width: 200px;" >
                  <a href="formthread.php?id=<?php echo $row['id'] ; ?>" style="color:black;font-weight: bold;">
                  <?php 
                    echo $row['judul']."<br></a>";
                  ?>
                  <font size="2" color="black">  
                  <?php
                    echo "dibuat oleh ";
                  ?>
                  <a href="user.php?id=<?php echo $row['iduser'] ; ?>" style="color:black;">
                  <?php
                    echo "<b>".$row['username']."</b></a>";
                    echo "&nbsp;&nbsp;".$row['created_at']."<br>";
                  ?>
                    <span style="font-weight: bold;font-size: 15px;">
                      Mata Pelajaran: 
                      <a href="formmatpel.php?idmatpel=<?php echo $row['idmatpel'] ; ?>" style="color:black;">
                  <?php
                    echo $row['namamatpel']."</a>";
                  ?>
                    </span>
              </font></td>
              <td width="15%" >
              <?php       
                include "koneksi.php";
                $idthread=$row['id'];
                $sql1="select * from tb_comment where idthread='$idthread'";
                $mysqli2=mysqli_query($mysqli,$sql1);
                $mysqli3=mysqli_num_rows($mysqli2); 
              ?>
                <center><i class="fas fa-reply-all" style="padding-bottom:10px;">&nbsp;Balasan</i><br>
                  <span style="font-size: 20px;">
                  <?php echo $mysqli3; ?>
                  </span>
                </center>
              </td>
              <td width="15%" >
                <center><i class="fas fa-eye" style="padding-bottom: 10px;">&nbsp;Dilihat</i><br>
                  <span style="font-size: 20px;">
                  <?php echo $row['view']; ?>
                  </span>
                </center>
              </td>   
              </tr>
            <?php
            }
            }else{
            ?>
            <tr><td bgcolor="white" style="padding: 50px;">
              <center><h2>
              Belum ada thread
              </h2></center>
            </td></tr>
            <?php
            }
            ?>
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