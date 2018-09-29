<?php
$id = $_POST['id_user'];
if(empty($_FILES['file']))
{
    exit();
}
$temp = explode(".", $_FILES["file"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$destinationFilePath = "assets/user/$id/".$newfilename ;
if(!move_uploaded_file($_FILES['file']['tmp_name'], $destinationFilePath)){
    echo $errorImgFile;
}
else{
    echo $destinationFilePath;
}
 
?>
