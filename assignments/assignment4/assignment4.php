<?php
if(isset($_POST)){
  require_once 'DisplayNames2.php';
  $addName = new DisplayNames2();

  $output = $addName->addClearNames();
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

  <title>Add Names Project</title>
</head>

<body>
    
  <div class="container">
    <h1>Add Names</h1>
    <form action="assignment4.php" method="post">
        <input class="btn btn-primary" type="submit" name="submitButton" id="submitButton" value="Add Name" >
        <input class="btn btn-primary" type="submit" name="clearButton" id="clearButton" value="Clear Names">
    
        <div class="form-group">
          <label for="name">Enter Name</label>
          <input type="text" class="form-control" name="fullname" id="name">
        </div>
        
       
        <div class="form-group">
          <label for="nameList">List of Names</label>
          <textarea class="form-control" style="height: 500px;" name="nameList" id="nameList"><?php echo $output ?></textarea>
        </div>
      </form>

  </div>
</body>

</html>