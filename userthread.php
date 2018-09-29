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

  .messageList1{
    width: 320px;
    padding: 10px;
    border: 2px solid white;
    margin: 0;  
    background-color: #b0b2ae;  
  }
  .messageList2{
    padding: 10px;
    border: 2px solid white;
    margin: 0;  
    background-color: #b0b2ae;  
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
  
  .footer {
    left: 0;
    bottom: 0;
    width: 100%;
    color: white;
    text-align: center;
  }

  #avatar{
    border:2px solid white;
  }

  input[type=radio] + label {
    
  } 

  input[type=radio]:checked + label {
    border:2px solid black;
    background-color:#black;
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

  
  .row2{
    display:none;
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
include "session.php";
if(isset($login_session)){
$sql="select * from tb_user where username='$login_session'";
$query=mysqli_query($mysqli,$sql);
$fetch=mysqli_fetch_array($query,MYSQLI_ASSOC);
?>
  <ul class="nav navbar-nav navbar-right">
      <li class="dropdown active"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$login_session ?></a>
        <ul class="dropdown-menu">    
            <li><a href="user.php?id=<?php echo $fetch['id']; ?>"> 
              Visitor Message
            </a></li>           
          <li class="active"><a href="userthread.php?id=<?php echo $fetch['id']; ?>">
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
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
  </ul>
<?php
}
?>
    </div>
</nav>
<br><br>
<?php
$iduser=$_GET['id'];
$sqluser="select * from tb_user where id='$iduser'";
$queryuser=mysqli_query($mysqli,$sqluser);
$fetchuser=mysqli_fetch_array($queryuser,MYSQLI_ASSOC);
$idperingkat=$fetchuser['idperingkat'];
$sqlperingkat="select * from tb_peringkat where id='$idperingkat'";
$queryperingkat=mysqli_query($mysqli,$sqlperingkat);
$fetchperingkat=mysqli_fetch_array($queryperingkat,MYSQLI_ASSOC);
$username=$fetchuser['username'];
$sqlthread="select * from tb_thread where username='$username'";
$querythread=mysqli_query($mysqli,$sqlthread);
$fetchthread=mysqli_num_rows($querythread);

if(isset($login_session)){
    $sqluserlogin="select * from tb_user where username='$login_session'";
    $queryuserlogin=mysqli_query($mysqli,$sqluserlogin);
    $fetchuserlogin=mysqli_fetch_array($queryuserlogin,MYSQLI_ASSOC);
}
?>
<div class="container" style="padding-top: 50px;">
    <div class="row" name="profileuser">
      <div class="col-sm-1"></div>
      <div class="col-sm-9 messageList" style="height:100px;padding-left: 40px;padding-top: 12px;background-color: #d5ede8;">
        <div class="row">
            <div class="col-sm-1">
                    <?php  
                    if(isset($login_session)){                      
                    if($login_session==$username){
                    ?>
                        <a href="#avatar1">
                        <img src="<?php $_SERVER['SERVER_NAME']; echo $fetchuser['avatar']; ?>" class="img" width="75px" height="75px" id="avatar" title="Klik avatar untuk mengganti"></a>
                    <?php
                    }else{
                    ?>
                        <img src="<?php $_SERVER['SERVER_NAME']; echo $fetchuser['avatar']; ?>" class="img" width="75px" height="75px" id="avatar">
                    <?php
                    }
                    }else{
                    ?>
                        <img src="<?php $_SERVER['SERVER_NAME']; echo $fetchuser['avatar']; ?>" class="img" width="75px" height="75px" id="avatar">
                    <?php
                    }
                    ?>
                        <div class="row">
                            <div class="col-sm-12"></div>
                        </div>
            </div>
            <div class="col-sm-4" style="padding-left: 40px;">
                      <div style="color:black;font-weight: bold;">
                      <?php
                          echo $fetchuser['username'];
                          echo "<br>";
                      ?>
                      </div>
                      <div style="padding-top: 4px;color:black;">
                      <?php
                          echo $fetchperingkat['peringkat'];
                      ?>
                      </div>
                      <div style="padding-top: 4px;color:black;">
                      <?php
                          $join=substr($fetchuser['created_at'],0,10);
                          echo "Tanggal Join: ".$join;
                      ?>
                      </div>
            </div>
            <div class="col-sm-5" style="padding-top: 5px;padding-bottom: 10px;">
                  <div class="messageList1" style="height:70px;">
                        <div style="color:black;">
                              <?php
                                echo "User ID: <b>".$fetchuser['id']."</b>";
                                echo "<br>";
                                echo "Total Post: <b>".$fetchthread."</b>";
                              ?>
                        </div>
                  </div>
            </div>
        </div>
      </div>
      <div class="col-sm-2"></div>      
    </div>

    <form action="gantiavatar.php?id=<?php echo $_GET['id'] ?>" method="POST">
      <div class="row2 row" name="avatar1" id="avatar1" style="padding-top: 20px;">
        <div class="col-sm-3"></div>
        <div class="col-sm-5 messageList" style="background-color: #d5ede8;text-align: center;">
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
          <br><br>
          <button type="submit" class="btn btn-info" value="Submit">Ganti Avatar</button>
        </div>
        <div class="col-sm-4"></div>
      </div>
      </form>




    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-7">
          <br>
            <a class="btn btn-primary" href="user.php?id=<?php echo $_GET['id'];?>" role="button">Visitor Message</a>
            <a class="btn btn-primary" href="userthread.php?id=<?php echo $_GET['id'];?>" role="button">Forum Thread</a>
            <a class="btn btn-primary" href="usercomment.php?id=<?php echo $_GET['id'];?>" role="button">Forum Comment</a>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <div class="row" name="listpostuser" style="padding-top: 20px;">
      <div class="col-sm-1"></div>
      <div class="col-sm-9 messageList" style="background-color: #d5ede8;padding-bottom: 20px;">
          <div id="listpost" class="tab-pane fade in active">
<?php
  $sqljoin="select tb_thread.id as id_thread,tb_thread.judul,tb_thread.created_at,tb_thread.view,tb_matpel.namamatpel,tb_matpel.id as id_matpel,count(tb_comment.idthread) as reply from tb_thread 
  RIGHT JOIN tb_matpel ON tb_thread.idmatpel = tb_matpel.id 
  left JOIN tb_comment ON tb_thread.id = tb_comment.idthread where tb_thread.username='$username' group by tb_thread.id";
  $queryjoin=mysqli_query($mysqli,$sqljoin);
  $per_page =5;//define how many games for a page
  $count = mysqli_num_rows($queryjoin);
  $pages = ceil($count/$per_page);
  if(!isset($_GET['page'])){
    $page="1";
  }else{
    $page=$_GET['page'];
  }
  $start    = ($page - 1) * $per_page;
  $sqljoin    = $sqljoin." ORDER BY created_at DESC LIMIT $start,$per_page";
  $query2=mysqli_query($mysqli,$sqljoin);

?>
      <div class="row">
          <div class="col-sm-5">
            <h3 style="font-weight: bold;">Forum Thread</h3>
          </div>
          <div class="col-sm-7"  style="text-align: right; padding-right: 50px;">            
            <ul class="pagination">
                <?php
              //Show page links
              for ($i = 1; $i <= $pages; $i++)
                {
              ?>
                <li id="<?php echo $i;?>"><a href="userthread.php?id=<?php echo $_GET['id'];?>&page=<?php echo $i;?>"><?php echo $i;?></a></li>
              <?php           
                }
              ?>
            </ul>
          </div>
      </div>
                <?php 
                        if(mysqli_num_rows($query2)>0){
                ?>
                <table class="table table-striped" border="2px">
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal Post</th>
                        <th>Views dan Replies</th>
                        <?php
                        if(isset($login_session)){
                        if($login_session==$username or $fetchuserlogin['idperingkat']==1){
                        ?>
                        <th>Action</th>
                        <?php
                        }
                        ?>
                        <?php
                        }
                        ?>
                    </tr>

                    <?php 
                        while($fetchjoin=mysqli_fetch_array($query2,MYSQLI_ASSOC)){
                    if(isset($login_session)){
                    if($login_session==$username){                  
                    ?>
                    <tr>
                        <td style="word-wrap: break-word;min-width: 160px;max-width: 200px;">
                          <a href="formthread.php?id=<?php echo $fetchjoin['id_thread']; ?>" style="color:black;">
                          <?php echo $fetchjoin['judul']; ?>   
                          </a>                         
                        </td>
                        <td style="word-wrap: break-word;min-width: 100px;max-width: 150px;">
                          <a href="formmatpel.php?idmatpel=<?php echo $fetchjoin['id_matpel']; ?>" style="color:black;">
                          <?php echo $fetchjoin['namamatpel']; ?>                            
                          </td>
                        <td><?php 
                        $tglcret=substr($fetchjoin['created_at'],0,16);
                        echo $tglcret; ?>                          
                        </td>
                        <td><?php echo "Replies:&nbsp;&nbsp;".$fetchjoin['reply']; ?>
                        <br>
                            <?php echo "Views:&nbsp; ".$fetchjoin['view']; ?>
                        </td>                        
                        <td>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="#" class="btn btn-default"  onclick="hapus(<?php echo $fetchjoin['id_thread']; ?>);return false;">Delete</a>
                                    <a href="edit_post.php?id=<?php echo $fetchjoin['id_matpel']; ?>&idthread=<?php echo $fetchjoin['id_thread']; ?>" class="btn btn-default">Edit</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php

                    }elseif($fetchuserlogin['idperingkat']==1){
                    ?>
                    <tr>
                        <td style="word-wrap: break-word;min-width: 160px;max-width: 200px;">
                          <a href="formthread.php?id=<?php echo $fetchjoin['id_thread']; ?>" style="color:black;">
                          <?php echo $fetchjoin['judul']; ?>   
                          </a>                         
                        </td>
                        <td style="word-wrap: break-word;min-width: 100px;max-width: 150px;">
                          <a href="formmatpel.php?idmatpel=<?php echo $fetchjoin['id_matpel']; ?>" style="color:black;">
                          <?php echo $fetchjoin['namamatpel']; ?>                            
                          </td>
                        <td><?php 
                        $tglcret=substr($fetchjoin['created_at'],0,16);
                        echo $tglcret; ?>                          
                        </td>
                        <td><?php echo "Replies:&nbsp;&nbsp;".$fetchjoin['reply']; ?>
                        <br>
                            <?php echo "Views:&nbsp; ".$fetchjoin['view']; ?>
                        </td>                        
                        <td>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="#" class="btn btn-default"  onclick="hapus(<?php echo $fetchjoin['id_thread']; ?>);return false;">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <?php 
                    }
                    }else{
                    ?>
                    <tr>
                        <td style="word-wrap: break-word;min-width: 160px;max-width: 200px;">
                          <a href="formthread.php?id=<?php echo $fetchjoin['id_thread']; ?>" style="color:black;">
                          <?php echo $fetchjoin['judul']; ?>   
                          </a>                         
                        </td>
                        <td style="word-wrap: break-word;min-width: 100px;max-width: 150px;">
                          <a href="formmatpel.php?idmatpel=<?php echo $fetchjoin['id_matpel']; ?>" style="color:black;">
                          <?php echo $fetchjoin['namamatpel']; ?>                            
                          </td>
                        <td><?php 
                        $tglcret=substr($fetchjoin['created_at'],0,16);
                        echo $tglcret; ?>                          
                        </td>
                        <td><?php echo "Replies:&nbsp;&nbsp;".$fetchjoin['reply']; ?>
                        <br>
                            <?php echo "Views:&nbsp; ".$fetchjoin['view']; ?>
                        </td>  
                    </tr>
                    <?php
                    } 
                    }
                  }else{ ?>
                    <br><center>                    
                        <h2 style="padding: 60px;">User ini belum pernah post</h2></center>
                    <?php
                    }
                    ?>
                </table>
          </div>
  
      </div>
      <div class="col-sm-2"></div>
    </div>
</div>

<div style="padding-top: 50px;">
  
</div>


<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[href^="#"]').on('click', function(event) {
    var target = $( $(this).attr('href') );
    target.fadeToggle(1000);

    });
    }); 


    function hapus(id){
    swal("Anda ingin hapus thread ini?", {
    buttons: {
    cancel: "Cancel",
    okay: true,
    },
    })
    .then((value) => {
    switch (value) {
    
    case "okay":
    window.location='delete_thread.php?id='+id;
    break;
    
    case "cancel":
    swal.close;
    }
    });
    }   



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
