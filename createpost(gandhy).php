<!DOCTYPE html>
<html lang="en">
  <head>
    <title> - Forum Tanya Jawab - </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="http://skripsi.com/assets/js/summernote.js"></script>

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
<div id="background">
    <img src="background.png" class="stretch" alt="" />
</div>
  <?php
  include "session.php";
      if(isset($login_session)){
  ?>
    <nav class="navbar navbar-inverse">
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
        <li><a href="#">Tentang Kami</a></li>
        <li><a href="#">FAQ</a></li>
      </ul>
      <?php
      if(isset($login_session)){
      ?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$login_session ?></a></li>
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
  $sqluser="select * from tb_user where username='$username'";
  $queryuser=mysqli_query($mysqli,$sqluser);
  $fetchuser=mysqli_fetch_array($queryuser,MYSQLI_ASSOC);
  $sqlthread1="select * from tb_thread where username='$username'";
  $querythread1=mysqli_query($mysqli,$sqlthread1);
  $fetchthread1=mysqli_num_rows($querythread1);
  ?>
  <br>
  <div class="container-fluid">
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
                        <label for="namamatpel">
                          <font color="white">Kategori: </font><font color="red">*</font>
                        </label>
                        <select class="form-control" id="namamatpel" name="namamatpel" style="width:350px;">
                        <?php                        
                        include "koneksi.php";
                        $idmatpel=$_GET['idmatpel'];
                        $sqlmatpel = "select * from tb_matpel";
                        $sqlmatpel1="select * from tb_matpel where id='$idmatpel'";
                        $mysqlimatpel=mysqli_query($mysqli,$sqlmatpel);
                        $mysqlimatpel1=mysqli_query($mysqli,$sqlmatpel1);
                        $hasil=mysqli_fetch_array($mysqlimatpel1,MYSQLI_ASSOC);
                        while($row=mysqli_fetch_array($mysqlimatpel)){
                        ?>
                          <option value="<?php echo $row["id"]; ?>" <?php if($row['namamatpel']===$hasil['namamatpel']) echo 'selected="selected"';?>>
                            <?php echo $row["namamatpel"]; ?> 
                          </option>
                        <?php
                        }
                        ?>
                        </select>  
                        <br>
                        <label for="judul"><font color="white">Judul: </font></label>
                        <input type="text" class="form-control" id="judul" name="judul" maxlength="255" placeholder="Judul thread" required="required">
                        <br>                     
                        <label for="isi"><font color="white">Isi: </font></label>
                        <textarea id="summernote" name="isi" required="required">
                        </textarea>
                        <br>                  
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
<script>     

      function Redirect(test){  
                      window.location="formthread.php?id="+test; 
                    // alert(test);
                } 

      function test(){
        var isi = $('#summernote').summernote('code');
        var kategori = $('#namamatpel').val();
        var judul = $('#judul').val();
        data = {
          isi ,
          kategori,
          judul
        } 
        var str_json = JSON.stringify(data);
        console.log(str_json);
        var httpc = new XMLHttpRequest(); // simplified for clarity
        var url = "post.php";
        httpc.open("POST", url, true); // sending as POST

        httpc.setRequestHeader("Content-Type", "application/json");
        // httpc.setRequestHeader("Content-Length", data.length); // POST request MUST have a Content-Length header (as per HTTP/1.1)

        httpc.onreadystatechange = function() { //Call a function when the state changes.
        if(httpc.readyState == 4 && httpc.status == 200) { // complete and no errors
            
                    swal("Thread berhasil dibuat", "", "success")
                    .then((value) => {
                    setTimeout(Redirect(httpc.responseText), 100);  
                    });
         // some processing here, or whatever you want to do with the response
            }
        }
        httpc.send(str_json);

      }

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