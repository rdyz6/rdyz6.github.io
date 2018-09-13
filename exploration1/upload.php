<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
      <style>
      header{
          background: url(background/b1.jpg);
          background-size:cover;
          background-position: center;
          min-height: 1000px;
      }
      @media screen and (max-width:670px){
          header{
              min-height:500px;
          }
      }
      .section{
      padding-top: 4vw;
      padding-bottom: 4vw;
    }
    
  </style>
</head>
echo "<header>";
<?php
$statusMsg = '';

//file upload path
$targetDir = "/var/www/html/exploration1/image/";
$fileName = basename($_FILES["image"]["name"]);
$name = $_FILES['image']['name'];
//$name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
$temp_name = $_FILES['image']['tmp_name'];
$type = $_FILES['image']['type'];
$size = $_FILES['image']['size'];
$dataTime = date("Y-m-d H:i:s");


$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["image"]["name"])) {
    //DB detail
    $dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = 'Toothless521';
    $dbName     = 'CS4380';/*should be CS4830, typo*/
    
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);//Create connection and select DB
    
    if($db->connect_error){
            die("Connection failed: " . $db->connect_error);
    }
    $insert = $db->query("INSERT INTO `exploration1` (`name`,`path`,`size`,`type`,`created`) VALUES ('$fileName','$targetFilePath', $size,'$type','$dataTime')");
    
    if($insert){
       echo "<div class='container grey lighten-2 box valign-wrapper'>File uploaded successfully.</div>";
       //allow certain file formats
       $allowTypes = array('jpg','png','jpeg','gif','pdf');
       if(in_array($fileType, $allowTypes)){
        
          //upload file to server
          if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
            
              $statusMsg = "<div class='container grey lighten-2 box valign-wrapper'>The file ".$fileName. " has been uploaded to directory.</div>";
        
          }else{
            
              $statusMsg = "<div class='container grey lighten-2 box valign-wrapper'>Sorry, there was an error uploading your file.</div>";
          }
    
       }else{
        
          $statusMsg = '<div >Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.</div>';
       }

    }else{
    
       $statusMsg = '<div>Please select a file to upload.</div>';
    }
            
}else{
       echo "<div>Can not uploaded image's data to Mysql.</div>";
    } 
    
    
    
    
    
    

//display status message
echo "<div><a href = '/exploration1/view.php'><span>check</span><i class='material-icons left'>folder</i></a></div><div><a href = '/exploration1'><span>Upload</span><i class='material-icons left'>folder-plus</i></a></div>";
echo "</header>";
?>
<script>
     $(document).ready(function(){
      $('.sidenav').sidenav();
      $('.materialboxed').materialbox();
      $('.parallax').parallax();
    });
 </script>