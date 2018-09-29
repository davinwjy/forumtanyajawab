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
<!--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script> -->
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

  .even { background-color:#FFF; }
  .odd { background-color:#f1f1f1; }

  #avatar{
    border:2px solid white;
  }

  textarea#isi{
      resize:none;    
  }
  </style>
  <body>
<div id="background" style="padding-top: 50px;">
    <img src="intro-1600-edit.jpg" class="stretch" alt="" />
</div>
  <?php
  include "session.php";
      if(isset($login_session)){
  ?>
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
      <?php
      if(isset($login_session)){
      $sqluser1="select * from tb_user where username='$login_session'";
      $queryuser1=mysqli_query($mysqli,$sqluser1);
      $fetch=mysqli_fetch_array($queryuser1,MYSQLI_ASSOC);
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
        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
      <?php
      }
      ?>
    </div>
  </nav>
  <?php
  include "koneksi.php";
  $username=$login_session;
  $idusername1=$id_session;
  $sqluser="select * from tb_user where username='$username'";
  $queryuser=mysqli_query($mysqli,$sqluser);
  $fetchuser=mysqli_fetch_array($queryuser,MYSQLI_ASSOC);
  $sqlthread1="select * from tb_thread where username='$username'";
  $querythread1=mysqli_query($mysqli,$sqlthread1);
  $fetchthread1=mysqli_num_rows($querythread1);
  ?>
  <br>
  <div class="container-fluid" style="padding-top: 50px;">
      <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-1" style="padding-top: 12px;">
                          <img src="<?php $_SERVER['SERVER_NAME']; echo $fetchuser['avatar']; ?>" class="img-circle" width="70px" height="70px" id="avatar">
                    </div>                    
                    <div class="col-sm-2" style="padding-left: 30px;">
                          <font color="#d7f7de"><h5><b>
                          <?php
                              echo "Username";
                              echo "<br><br>";
                              $join=substr($fetchuser['created_at'],0,10);
                              echo "Tanggal Join";                             
                              echo "<br><br>";
                              echo "Posts";
                          ?>
                          </b></h5></font>
                    </div>                   
                    <div class="col-sm-7" style="padding-left: 1px;">
                          <font color="#d7f7de"><h5><b>
                          <?php
                              echo ": ".$fetchuser['username'];
                              echo "<br><br>";
                              $join=substr($fetchuser['created_at'],0,10);
                              echo ": ".$join;                               
                              echo "<br><br>"; 
                              echo ": ".$fetchthread1;
                          ?>
                          </b></h5></font>
                    </div>

                </div>               
                <hr>
                <div class="row">
                  <div class="col-sm-12">
                    <form method="POST">
                      <div class="form-group">      
                        <?php   
                        include "koneksi.php";
                        $sqledit="select tb_comment.*,tb_thread.judul from tb_comment
                        left join tb_thread on tb_comment.idthread=tb_thread.id
                        where tb_comment.id=".$_GET['id'];
                        $mysqliedit=mysqli_query($mysqli,$sqledit);
                        $rowedit=mysqli_fetch_array($mysqliedit,MYSQLI_ASSOC);
                        ?>
                        <br>
                        <label for="judul"><font color="white">Judul Thread: </font></label>
                        <input type="text" class="form-control" id="judul" name="judul" maxlength="255" required="required" value="<?php echo $rowedit['judul']; ?>" disabled="disabled">
                        <br>                     
                        <label for="isi"><font color="white">Isi Komentar: </font></label>
                        <textarea id="summernote" name="isi" required="required">
                          <?php
                          echo $rowedit['isi'];
                          ?>
                        </textarea>      
                        <button type="Submit" class="btn btn-info" value="Submit" onclick="test();">Submit Thread</button>
                        <br>
                      </div>
                    </form>
                   </div>
                </div>
          </div>          
          <div class="col-sm-8"></div>
      </div>  
  </div>
  <br>
<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){
  include "koneksi.php";
  $isi=$_POST['isi'];
  $idcomment=$_GET['id'];
  $idthread2=$_GET['idthread'];
  $sql = "update tb_comment set isi='$isi'
  where id='$idcomment'";
    if ($query=mysqli_query($mysqli,$sql)){
?>

<script type="text/javascript">
  function Redirect(){
    window.location="formthread.php?id=<?php echo $idthread2;  ?>";
  } 
  swal("Komentar Berhasil Diedit!", "", "success")
    .then((value) => {
    setTimeout('Redirect()', 100);  
    });
</script>
  <?php       
    }
  mysqli_close($mysqli);
}
?>

<script> 
      $(document).ready(function() {
      $("#summernote").summernote({
        placeholder: 'enter directions here...',
              height: 300,
               callbacks: {
              onImageUpload : function(files, editor, welEditable) {
       
                   for(var i = files.length - 1; i >= 0; i--) {
                           sendFile(files[i], this);
                  }
              }
          }
          });
      });

      function sendFile(file, el) {
      var form_data = new FormData();
      form_data.append('file', file);
      form_data.append('id_user',<?php echo $idusername1; ?>)
      $.ajax({
          data: form_data,
          type: "POST",
          url: 'upload.php',
          cache: false,
          contentType: false,
          processData: false,
          success: function(url) {
              $(el).summernote('editor.insertImage', url);
          }
      });
      }

</script>

  <?php
      }else{
  ?>    
    <script type="text/javascript">
        function Redirect(){  
        window.location="login.php"; 
        } 
          swal("Anda belum melakukan login!!", "", "error")
          .then((value) => {
          setTimeout('Redirect()', 100);  
          });        
    </script>
  <?php
  }
  ?> 

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