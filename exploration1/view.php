


<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <style>
 
</style>
    <title>
    Uploading Your image
    </title>
</head>



<table width = "600" border = "1" cellpadding = "1" cellspacing = "1" class="highlight">
    <th>IMAGE</th>
    <th>image name</th>
    <th>image path</th>
    <th>image size</th>
    <th>image type</th>
    <th>date</th>
    

<?php

    //DB details
    $dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = 'Toothless521';
    $dbName     = 'CS4380';
    
    //Create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }
    $sql="SELECT path,size,type,created FROM exploration1";
    $result = $db->query($sql);
    
     if($result->num_rows>0){
        
         
         while($row = $result->fetch_assoc()){
             $path=str_replace("/var/www/html/exploration1/", "", $row['path']);
             //$path = 'wwww';
             echo "<tr>
                  <td><a href = '".$path."'><img src='".$path."' height='200' width='200'></a></td>
                  <td>".$row['name']."</td>
                  <td>".$row['path']."</td>
                  <td>".$row['size']."</td>
                  <td>".$row['type']."</td>   
                  <td>".$row['created']."</td>
              </tr>";
             //echo "$path";
        }
        

     }
    //Get image data from database
   
?>

</table>
<div><a href = '/exploration1'>
         <span>
			 Upload more
		 </span>
         <i class="material-icons left">folder</i>
       </a></div>
<script>
     $(document).ready(function(){
      $('.sidenav').sidenav();
      $('.materialboxed').materialbox();
      $('.parallax').parallax();
    });
 </script>
