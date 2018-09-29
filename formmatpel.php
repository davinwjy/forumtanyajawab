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

  .messageList {

    -moz-box-shadow: 0 0 2px #C7CBCC !important;
    -webkit-box-shadow: 0 0 2px #C7CBCC !important;
    box-shadow: 0 0 2px #C7CBCC !important;
    padding: 10px;
    border: 1px solid #C4C4C4;
    -moz-box-border-radius: 10px 10px 10px 10px;
    -webkit-box-border-radius: 10px 10px 10px 10px;
    border-radius: 10px 10px 10px 10px;
  }

  .even { background-color:#FFF; }
  .odd { background-color:#f1f1f1; }
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
          <li class="dropdown active"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategori <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
            include "koneksi.php";
            $sqlmatpel = "select * from tb_matpel";
            $mysqlimatpel=mysqli_query($mysqli,$sqlmatpel);            
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
      $sqluser="select * from tb_user where username='$login_session'";
      $queryuser=mysqli_query($mysqli,$sqluser);
      $fetch=mysqli_fetch_array($queryuser,MYSQLI_ASSOC);
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
  $idmatpel=$_GET['idmatpel'];

  $sql="select  tb_thread.* , count(tb_comment.idthread) as replies FROM `tb_thread` 
  left join tb_comment on tb_thread.id = tb_comment.idthread 
  WHERE tb_thread.idmatpel='$idmatpel' 
  group by tb_thread.id";

  $sql1="select namamatpel from tb_matpel where id=".$idmatpel;
  $mysqli1=mysqli_query($mysqli,$sql);
  $mysqli2=mysqli_query($mysqli,$sql1);
  $row=mysqli_fetch_row($mysqli2);

            $per_page =10;//define how many games for a page
            $count = mysqli_num_rows($mysqli1);
            $pages = ceil($count/$per_page);
            if(!isset($_GET['page'])){
              $page="1";
            }else{
              $page=$_GET['page'];
            }

            $start    = ($page - 1) * $per_page;
            if(isset($_GET['orderby'])){
              if(isset($_GET['sort'])){
              $order=$_GET['orderby'];
              $sorting=$_GET['sort'];
              if($order=='judul'){
              $sql    = $sql." ORDER BY $order $sorting LIMIT $start,$per_page";
              }else{
              $sql    = $sql." ORDER BY $order $sorting LIMIT $start,$per_page";
              }
            }  
            }else{
              $sql    = $sql." ORDER BY created_at DESC LIMIT $start,$per_page";
            }

            $query2=mysqli_query($mysqli,$sql);      
  ?>    
  </div>

  <div class="container" style="padding-top: 60px;">
    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8" style="padding-bottom: 50px">
          <h2><font color="white">
              <?php
              echo $row[0];
              ?>
          </font></h2>
                  <div class="row">
                      <div class="col-sm-3" style="padding-top: 25px;">
                          <a href="createpost.php?idmatpel=<?php echo $_GET["idmatpel"];?>" class="btn btn-primary btn-md" role="button" aria-disabled="true"> 
                          Tulis Thread
                          </a> 
                      </div>
                      <div class="col-sm-5">
                            <form action="searchforum.php?idmatpel=<?php echo $_GET['idmatpel']; ?>" style="padding-left: 50px;padding-top: 25px;" method="POST">
                              <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search di kategori ini" name="searchkategori" id="searchkategori">
                                <div class="input-group-btn">
                                  <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                  </button>
                                </div>
                              </div>
                            </form>
                      </div>
                      <div class="col-sm-4" style="text-align: right;padding-right: 50px;padding-top: 5px;">                                    
                        <ul class="pagination">
                          <?php
                          //Show page links
                          for ($i = 1; $i <= $pages; $i++)
                            {
                          if(isset($_GET['orderby'])){    
                          ?>
                            <li id="<?php echo $i;?>"><a href="formmatpel.php?idmatpel=<?php echo $_GET['idmatpel'];?>&page=<?php echo $i;?>&orderby=<?php echo $_GET['orderby'];?>&sort=<?php echo $_GET['sort']; ?>"><?php echo $i;?></a></li>
                          <?php 
                          }else{
                          ?>
                          <li id="<?php echo $i;?>"><a href="formmatpel.php?idmatpel=<?php echo $_GET['idmatpel'];?>&page=<?php echo $i;?>"><?php echo $i;?></a></li>
                          <?php
                          }          
                            }
                          ?>
                        </ul> 
                      </div>   
                  </div>
          
              <table class="table table-bordered">
              <thead>
                <tr>
                  <?php
                  if(isset($_GET['sort'])){
                    if($_GET['sort']=="asc"){
                  ?>
                    <th width="50%" style="background-color: #d5ede8;"><font size="3" color="black"><b>
                    <a href="formmatpel.php?idmatpel=<?php echo $_GET['idmatpel'];?>&orderby=judul&sort=desc">Judul,Dibuat oleh, Tanggal Post</b></font></th>
                    <th width="10%" style="background-color: #d5ede8;"><font size="3" color="black"><b>
                    <a href="formmatpel.php?idmatpel=<?php echo $_GET['idmatpel'];?>&orderby=replies&sort=desc">Balasan </b><i class="fas fa-reply-all"></i></a></font></th>
                    <th width="10%" style="background-color: #d5ede8;"><font size="3" color="black"><b>
                    <a href="formmatpel.php?idmatpel=<?php echo $_GET['idmatpel'];?>&orderby=view&sort=desc">Dilihat </b><i class="fas fa-eye"></i></a></font></th>
                  <?php
                    }else{
                  ?>
                    <th width="50%" style="background-color: #d5ede8;"><font size="3" color="black"><b>
                    <a href="formmatpel.php?idmatpel=<?php echo $_GET['idmatpel'];?>&orderby=judul&sort=asc">Judul,Dibuat oleh, Tanggal Post</b></font></th>
                    <th width="10%" style="background-color: #d5ede8;"><font size="3" color="black"><b>
                    <a href="formmatpel.php?idmatpel=<?php echo $_GET['idmatpel'];?>&orderby=replies&sort=asc">Balasan </b><i class="fas fa-reply-all"></i></a></font></th>
                    <th width="10%" style="background-color: #d5ede8;"><font size="3" color="black"><b>
                    <a href="formmatpel.php?idmatpel=<?php echo $_GET['idmatpel'];?>&orderby=view&sort=asc">Dilihat </b><i class="fas fa-eye"></i></a></font></th>
                  <?php
                      }
                  }else{
                  ?>
                    <th width="50%" style="background-color: #d5ede8;"><font size="3" color="black"><b>
                    <a href="formmatpel.php?idmatpel=<?php echo $_GET['idmatpel'];?>&orderby=judul&sort=desc">Judul,Dibuat oleh, Tanggal Post</b></font></th>
                    <th width="10%" style="background-color: #d5ede8;"><font size="3" color="black"><b>
                    <a href="formmatpel.php?idmatpel=<?php echo $_GET['idmatpel'];?>&orderby=replies&sort=desc">Balasan </b><i class="fas fa-reply-all"></i></a></font></th>
                    <th width="10%" style="background-color: #d5ede8;"><font size="3" color="black"><b>
                    <a href="formmatpel.php?idmatpel=<?php echo $_GET['idmatpel'];?>&orderby=view&sort=desc">Dilihat </b><i class="fas fa-eye"></i></a></font></th>
                  <?php  
                  }
                  ?>
                </tr>
              </thead>
              <tbody> 
                  <?php    
                    if(mysqli_num_rows($query2)>0){         
                    while($row=mysqli_fetch_assoc($query2)){
                  ?>                 
                <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">                  
                  <td width="50%" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">
                      <h4 class="media-heading">
                      <a href="formthread.php?id=<?php echo $row["id"] ?>" style="color: black;">
                      <?php
                      echo ($row["judul"]);
                      ?>
                      <br>
                      </a>  
                      </h4>  
                      <b>                      
                        <?php
                          echo ("dibuat oleh : ");
                          $username11=$row['username'];
                          $sqluser1="select * from tb_user where username='$username11'";
                          $queryuser1=mysqli_query($mysqli,$sqluser1);
                          $fetchuser1=mysqli_fetch_array($queryuser1,MYSQLI_ASSOC);
                        ?>
                          <a href="user.php?id=<?php echo $fetchuser1['id'] ; ?>" style="color:black;">
                        <?php
                          echo $row["username"];
                        ?>
                          </a>
                        <?php
                          echo (", Tanggal Post : ".$row["created_at"]);    
                        ?>    
                        </b>
                  </td>
                  <td width="10%">
                        <font color="black" size="3"><b>
                        <?php             
                          echo $row['replies'];
                        ?>
                        </b></font>
                  </td>
                  <td width="10%">
                        <font color="black" size="3"><b>
                        <?php             
                          echo $row["view"];
                        ?>
                        </b></font>
                  </td>
                </tr> 
                    <?php
                    }  
                    }else{
                    ?>    
                <br>
                <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">
                <td colspan="3" style="padding: 50px;"> 
                    <font color="black"><b>
                          <center>    
                          <h1>
                            <p>
                                Thread belum ada
                            </p>
                          </h1>
                          </center>
                    </b></font>
                </td>
                </tr>                                  
              </tbody>                                      
              </table>
     </div>
          <?php
          }
          ?>
      <div class="col-sm-3">
      </div> 
    </div>
  </div>     
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

<!--  
  <div class="footer" style="background-color: #F8F8F8;padding-top:5px;">
  <h5 style="color:black;">
    Email : davinwijaya16@gmail.com<br>
    Davin Wijaya @STMIK Widya Dharma 2018<br>
  </h5>
  </div> -->
</html>