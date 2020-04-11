<?php

require_once 'classes/Date_time.php';
$dt = new Date_time();
$notes = $dt->checkAddNote();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Date Time Assignment</title>
</head>

<body>

    <div class="container">

        <h1>Add Note</h1>

        <p> <a href='displayNotes.php'>Display Notes</a> </p>

        <?php echo $notes;   ?>

        <form action="assignment9.php" method="post">

            <div class="form-group">
                <label for="dateTime">Date and Time</label>
                <input type="datetime-local" class="form-control" name="dateTime" id="dateTime">
            </div>

            <div class="form-group">
                <label for="noteList">Note</label>
                <textarea class="form-control" style="height: 225px;" name="textInput" id="textInput">

                </textarea>
            </div>
            <input class="btn btn-primary" type="submit" name="addNote" id="addNote" value="Add Note">
        </form>

    </div>
</body>

</html>