<?php

require_once 'createDir.php';

if(isset($_POST['submitButton']))  { $submitted = true;  }
else { $submitted = false; }

if($submitted){
  $myDir = new Directories();
}


if(isset($_POST['dirName'])){
  $myDir->mkDirAndFile(); 
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>File and Directory Assignment</title>
</head>

<body>
    
  <div class="container">
    
    <h1>File and Directory Assignment</h1>
    <p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only.</p>

    <p>
      <?php 

      if($submitted)  {
        echo $myDir->getDirStatus();
      }else{
        echo "";
      }
       
      ?>

    </p>
  
    <?php

    if($submitted){
      $path = "directories/".$_POST['dirName']."/readme.txt";
      echo "<a href= $path>Path where file is located</a>"; 
    }
      
    ?>

    <br><br>

    <form action="assignment5.php" method="post">
    
        <div class="form-group">
          <label for="folderName">Folder Name</label>
          <input type="text" class="form-control" name="dirName" id="dirName">
        </div>
        
       
        <div class="form-group">
          <label for="nameList">File Content</label>
          <textarea class="form-control" style="height: 225px;" name="textInput" id="textInput"><?php 

         
            
          ?></textarea>
        </div>
        <input class="btn btn-primary" type="submit" name="submitButton" id="submitButton" value="Submit" >
      </form>

  </div>
</body>

</html>