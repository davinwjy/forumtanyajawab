<!DOCTYPE html>
<?php
include "session.php"
?>
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
    /*button[data-name=resizedDataImage]  {
        position: relative;
        overflow: hidden;
    }

    button[data-name=resizedDataImage] input {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        opacity: 0;
        font-size: 200px;
        max-width: 100%;
        -ms-filter: 'alpha(opacity=0)';
        direction: ltr;
        cursor: pointer;
    }*/

  .row2{
  	display: none;
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

/*  .vl {
      border-left: 6px solid black;
      height: 200px;
  }*/

  textarea#komentar{
      resize:none;    
  }

  #avatar{
    border:2px solid white;
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
      if(isset($login_session)){
      $sqluser2="select * from tb_user where username='$login_session'";
      $queryuser2=mysqli_query($mysqli,$sqluser2);
      $fetch=mysqli_fetch_array($queryuser2,MYSQLI_ASSOC);
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
      $id=$_GET['id'];
      $sqltambahview="UPDATE tb_thread SET view = view + 1 WHERE id = '$id'";
      $querysqltambah=mysqli_query($mysqli,$sqltambahview);
      $sqlthread="select * from tb_thread where id='$id'";
      $querythread=mysqli_query($mysqli,$sqlthread);
      $fetchthread=mysqli_fetch_array($querythread,MYSQLI_ASSOC);
      $username=$fetchthread['username'];
      $sqluser="select * from tb_user where username='$username'";
      $queryuser=mysqli_query($mysqli,$sqluser);
      $fetchuser=mysqli_fetch_array($queryuser,MYSQLI_ASSOC);
      $sqlthread1="select * from tb_thread where username='$username'";
      $querythread1=mysqli_query($mysqli,$sqlthread1);
      $fetchthread1=mysqli_num_rows($querythread1);
      $peringkat=$fetchuser['idperingkat'];
      $sqlperingkat="select * from tb_peringkat where id='$peringkat'";
      $queryperingkat=mysqli_query($mysqli,$sqlperingkat);
      $fetchperingkat=mysqli_fetch_array($queryperingkat,MYSQLI_ASSOC);
  ?>
  <br>
  <div class="container-fluid" style="padding-top: 50px;">
      <div class="row" name="userinfo">
          <div class="col-sm-1"></div>
          <div class="col-sm-8">
              <div class="row">
                    <div class="col-sm-1" style="padding-top: 12px;padding-left: 40px;">
                          <img src="<?php $_SERVER['SERVER_NAME']; echo $fetchuser['avatar']; ?>" class="img-circle" width="70px" height="70px" id="avatar"">
                    </div>                    
                    <div class="col-sm-9" style="padding-left: 50px;padding-top: 14px;">
                          <font color="#d7f7de"><h5><b>
                              <a href="user.php?id=<?php echo $fetchuser['id']; ?>" style="color:#d7f7de;">
                          <?php
                              echo $fetchuser['username'];
                              echo "</a><br><br>";
                              echo $fetchperingkat['peringkat'];                              
                              $join=substr($fetchuser['created_at'],0,10);
                              echo "&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Tanggal Join:&nbsp;&nbsp;".$join."&nbsp;&nbsp;Post:&nbsp;&nbsp;".$fetchthread1;    
                          ?>
                          </b></h5></font>
                    </div> 
              </div>
              <hr>            
          </div>        
          <div class="col-sm-3"></div>
      </div>


      <div class="row" name="threadinfo">
        <div class="col-sm-1"></div>
        <div class="col-sm-8">          
          <div class="judul" style="color:white;padding-bottom: none;font-size: 20px;padding-top: none; word-wrap: break-word;padding-left: 13px;">
          <b>
          <?php
            echo $fetchthread['judul'];
          ?>
          </b>
          </div>
          <div id="messageList" class="messageList" style="background-color: #e2fbff;"> 
              <div class="created" style="color:black;padding-bottom: 6px" >
                      <?php
                        echo "Tanggal Post: ".$fetchthread['created_at'];
                      ?>
              </div>
              <div id="messageList" class="messageList " style="background-color: white">
                    <div class="isi" style="color:black;font-family:times-new roman;font-size: 18px;word-wrap: break-word;padding-right: 10px;padding-bottom: 70px;overflow: hidden;">
                    <?php
                      echo $fetchthread['isi'];
                    ?>                 
                    </div>  
              </div>  
              <div class="tombol" style="text-align: right;padding-top: 2px;" >  
                  <?php
                  if(isset($login_session)){  
                      $username1=$login_session; 
                      $idusername1=$id_session;
                      if($username==$username1){
                      	$sqllike="select * from tb_likethread where username='$username1' and idthread='$id'";
                      	$querylike=mysqli_query($mysqli,$sqllike);
                      	$rowlike=mysqli_num_rows($querylike);
                      	if($rowlike>0){
                      	?>
<!--                       		 <a onclick="javascript:changeText(<?php echo $_GET['id']; ?>,0)" class="like1" id="like1"><i class="fas fa-thumbs-down">Unlike</i></a>&nbsp;&nbsp; -->
                      	<?php
                      	}else{
                      	?>
<!--                  			 <a onclick="javascript:changeText(<?php echo $_GET['id']; ?>,0)" class="like1" id="like1"><i class="fas fa-thumbs-up">Like</i></a>&nbsp;&nbsp; -->
                      	<?php
                      	}                      	
                  ?>                

                  <a href="edit_post.php?id=<?php echo $fetchthread['idmatpel']; ?>&idthread=<?php echo $_GET['id']; ?>"><i class="fas fa-edit">Edit</i></a>&nbsp;&nbsp;


                  <a href="#comment"><i class="fas fa-reply-all">Reply</i></a>&nbsp;&nbsp;
                  <?php
                      }else{
                  ?>
<!--                   <a onclick="javascript:changeText(<?php echo $_GET['id']; ?>,0)" class="like1" id="like1"><i class="fas fa-thumbs-up">Like</i></a>&nbsp;&nbsp; -->
                  <a href="#comment"><i class="fas fa-reply-all">Reply</i></a>&nbsp;&nbsp;
                  <?php
                      }
                  }else{
                  ?>
                  &nbsp;&nbsp;
                  <?php
                  }
                  ?>                  
              </div>  
          </div>     
        </div>
        <div class="col-sm-3"></div>                  
      </div> 

      <form action="#" method="POST">
      <div class="row2 row" name="comment" id="comment">
        <div class="col-sm-1"></div>
        <div class="col-sm-8" style="padding-left: 50px;">
          <br>
          <textarea rows="12" id="summernote" name="summernote" placeholder="Komentar Thread" style="width: 700px;"></textarea>
          <div align="right" style="padding-right: 30px;"><button type="submit" class="btn btn-info" value="Submit">Submit Comment</button></div>
        </div>
        <div class="col-sm-3"></div>
      </div>
      </form>

      <?php
      // $sqlkomentar="select * from tb_comment where idthread='$id'";
      $sqlkomentar="Select tb_comment.*, count(tb_likecomment.idcomment) as jumlah FROM tb_comment LEFT JOIN tb_likecomment on tb_comment.id=tb_likecomment.idcomment where tb_comment.idthread='$id' GROUP BY tb_comment.id order by jumlah desc";
      $querykomentar=mysqli_query($mysqli,$sqlkomentar);
      $per_page =4;//define how many games for a page
      $count = mysqli_num_rows($querykomentar);
      $pages = ceil($count/$per_page);
      if(!isset($_GET['page'])){
        $page="1";
      }else{
        $page=$_GET['page'];
      }
      $start    = ($page - 1) * $per_page;
      $sqlkomentar     = $sqlkomentar." LIMIT $start,$per_page";
      $query2=mysqli_query($mysqli,$sqlkomentar);
      ?>    

      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-8" style="text-align: right; padding-right: 30px;padding-left: 50px;">
          <ul class="pagination">
            <?php
            //Show page links
            for ($i = 1; $i <= $pages; $i++)
              {
            ?>
              <li id="<?php echo $i;?>"><a href="formthread.php?id=<?php echo $_GET['id'];?>&page=<?php echo $i;?>"><?php echo $i;?></a></li>
            <?php           
              } 
            ?>
          </ul>  
       </div>
        <div class="col-sm-3"></div>
      </div>
      <?php   
      while($row=mysqli_fetch_assoc($query2)){
      ?>  
      <div class="row" name="listcomment" style="padding-left: 20px;">
      <?php
      $user=$row["username"];
      $sqluser1="select * from tb_user where username='$user'";
      $queryuser1=mysqli_query($mysqli,$sqluser1);
      $fetchuser1=mysqli_fetch_assoc($queryuser1);       
      $sqlthread2="select * from tb_thread where username='$user'";
      $querythread2=mysqli_query($mysqli,$sqlthread2);
      $fetchthread2=mysqli_num_rows($querythread2); 
      $peringkat1=$fetchuser1['idperingkat'];
      $sqlperingkat1="select * from tb_peringkat where id='$peringkat1'";
      $queryperingkat1=mysqli_query($mysqli,$sqlperingkat1);
      $fetchperingkat1=mysqli_fetch_array($queryperingkat1,MYSQLI_ASSOC);
      ?>
        <div class="col-sm-1">                
        </div>
        <div class="col-sm-8">
            <div id="messageList" class="messageList" name="isikomentar" style="background-color: #e2fbff; width:800px;"> 
              <div style="color:black; padding-left: 1px;padding-bottom: 5px;">
              <?php
                echo "Dijawab tanggal: ".$row["created_at"];
              ?>
              </div>
                  <div class="col-sm-2" name="infouser" style="color:black;padding-top: 10px;padding-left: 20px;padding-right: 5px;">
                      <img src="<?php $_SERVER['SERVER_NAME']; echo $fetchuser1['avatar']; ?>" width="70px" height="70px" style="padding-left: 1px;">
                      <br><br>
                        <div class="row">
                            <div class="col-sm-12" style="padding-left: 1px;font-size: 12px;">
                              <a href="user.php?id=<?php echo $fetchuser1['id']; ?>" style="color:black;">
                              <?php
                              echo $fetchuser1["username"];
                              echo "</a>";
                              echo "<br>";
                              echo $fetchperingkat1['peringkat'];
                              echo "<br>";
                              $join=substr($fetchuser['created_at'],0,10);
                              echo "Joined :&nbsp;&nbsp;".$join;
                              echo "<br>";
                              echo "Posts :&nbsp;&nbsp;".$fetchthread2;
                              ?>
                            </div>
                        </div>
                  </div>          
                  <div class="col-sm-1">     
                  </div> 
                  <div class="col-sm-7 messageList" name="isikomen" style="background-color: white;color:black;padding-top: 10px;padding-left: 10px; width:630px;word-wrap: break-word;padding-bottom: 150px;overflow: hidden;">
                      <?php
                          echo $row["isi"];
                      ?>
                  </div>
                  <div style="text-align: right; padding-right: 15px;padding-top: 30px;" name="tombollikecomment" ><br>
                    <?php                    
                    echo "<b>Liked: ".$row['jumlah']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>";
                    if(isset($login_session)){  
                        $username1=$login_session;
                      	$idusername1=$id_session; 
                      	$idcmt=$row['id'];
                
                      	$sqllikecomment="select * from tb_likecomment where username='$username1' and idcomment='$idcmt' and idthread='$id'";
                      	$querylikecomment=mysqli_query($mysqli,$sqllikecomment);
                      	$rowlikecomment=mysqli_num_rows($querylikecomment);                        
                      		if($rowlikecomment>0){
                      		?>
                      			<a class="like2" id="likee<?php echo $row['id']; ?>" onclick="javascript:changeText(<?php echo $_GET['id']; ?>,<?php echo $row['id']; ?>)"><i class="fas fa-thumbs-down">Unlike</i></a>&nbsp;&nbsp;

                      		<?php
                      		}else{
                      		?>

                    			<a class="like2" id="likee<?php echo $row['id']; ?>" onclick="javascript:changeText(<?php echo $_GET['id']; ?>,<?php echo $row['id']; ?>)"><i class="fas fa-thumbs-up">Like</i></a>&nbsp;&nbsp;

                      		<?php
                      		}  
                          
                        if($username1==$user){
                        ?>
                        <a href="edit_comment.php?idthread=<?php echo $_GET['id']; ?>&id=<?php echo $idcmt; ?>"><i class="fas fa-edit">Edit</i></a>&nbsp;&nbsp;
                        <?php
                        }               
                        
                    }else{
                    ?>
                    &nbsp;&nbsp;&nbsp;
                    <?php
                    }
                    ?>
                  </div>
            </div>
                  <br>
        </div>        
        <div class="col-sm-3"></div>
      </div>
      <?php
      }
      ?>    
<div style="padding-bottom: 50px;"></div> 
  <script type="text/javascript">
    jQuery(document).ready(function($) {
    $('a[href^="#"]').on('click', function(event) {
    var target = $( $(this).attr('href') );
    target.fadeToggle(1000);

    });
    });  


    $(document).ready(function() {
      $("#summernote").summernote({
        placeholder: 'Isi Komentar Thread',
              height: 200,
               callbacks: {
              onImageUpload : function(files, editor, welEditable) {
       
                   for(var i = files.length - 1; i >= 0; i--) {
                           sendFile(files[i], this);
                  }
              }
          }
          });
      });

        // $(function () {
        // $('.summernote').summernote({
        //     height: 250,
        //     toolbar: [
        //         ['insert', ['resizedDataImage', 'link']]
        //     ]
        //     });
        // });
      
      function changeText(idpost,idcomment) {
      var form_data = new FormData();
      		if(idcomment==0){  
      			var like = document.getElementById("like1");
      			if (like.innerHTML === '<i class="fas fa-thumbs-up">Like</i>') {

      				like.innerHTML = '<i class="fas fa-thumbs-down">Unlike</i>';	

      			form_data.append('user',"<?php echo $username1; ?>")
      			form_data.append('idthread',"<?php echo $_GET['id']; ?>")
      			      $.ajax({
				          data: form_data,
				          type: "POST",
				          url: 'likethread.php',
				          cache: false,
				          contentType: false,
				          processData: false,
				          success: function() {
				              console.log(form_data)
				          }
				      });

		        } else {

		            like.innerHTML = '<i class="fas fa-thumbs-up">Like</i>';

		        form_data.append('user',"<?php echo $username1; ?>")
      			form_data.append('idthread',"<?php echo $_GET['id']; ?>")
      			      $.ajax({
				          data: form_data,
				          type: "POST",
				          url: 'unlikethread.php',
				          cache: false,
				          contentType: false,
				          processData: false,
				          success: function() {
				              console.log(form_data)
				          }
				      });	

		        }

      		}else if(idcomment>0){
      			var like = document.getElementById('likee'+ idcomment);
      			if (like.innerHTML === '<i class="fas fa-thumbs-up">Like</i>'){

      				like.innerHTML = '<i class="fas fa-thumbs-down">Unlike</i>';

      			form_data.append('idcomment',+idcomment);	
      			form_data.append('user',"<?php echo $username1; ?>")
      			form_data.append('idthread',"<?php echo $_GET['id']; ?>")
      			      $.ajax({
				          data: form_data,
				          type: "POST",
				          url: 'likecomment.php',
				          cache: false,
				          contentType: false,
				          processData: false,
				          success: function() {
				              console.log(form_data)
				          }
				      });

      			} else {
		            like.innerHTML = '<i class="fas fa-thumbs-up">Like</i>';

      			form_data.append('idcomment',+idcomment);	
      			form_data.append('user',"<?php echo $username1; ?>")
      			form_data.append('idthread',"<?php echo $_GET['id']; ?>")
      			      $.ajax({
				          data: form_data,
				          type: "POST",
				          url: 'unlikecomment.php',
				          cache: false,
				          contentType: false,
				          processData: false,
				          success: function() {
				              console.log(form_data)
				          }
				      });
		        }

      		}
		}


      function sendFile(file, el) {
      var form_data = new FormData();
      // console.log(form_data)
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
  <?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
  include "koneksi.php";
    $username1=$login_session; 
    $id2=$_GET['id'];
    $isi=$_POST['summernote'];
    $sql = "insert into tb_comment (isi,idthread,username) values ('$isi','$id2','$username1')";
    $mysqli1=mysqli_query($mysqli,$sql);    
  ?>
  <script type="text/javascript">
    function Redirect(){  
          window.location="formthread.php?id=<?php echo $id2; ?>"; 
    } 
            swal("Komentar berhasil dibuat", "", "success")
            .then((value) => {
            setTimeout('Redirect()', 100);  
            }); 
  </script>
  <?php
  }
  ?>  
</body>
</html>