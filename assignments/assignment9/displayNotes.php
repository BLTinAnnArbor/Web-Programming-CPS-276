<?php

require_once 'classes/Date_time.php';
$dt = new Date_time();
$notes = $dt->checkGetNotes();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

    <title>Date Time Assignment</title>
</head>

<body>

    <div class="container">

        <h1>Display Notes</h1>
        <p> <a href='assignment9.php'>Add Note</a> </p>
        
        <form action="displayNotes.php" method="post">

            <div class="form-group">
                <label for="begDate">Beginning Date</label>
                <input type="date" class="form-control" name="begDate" id="begDate">
            </div>

            <div class="form-group">
                <label for="endDate">Ending Date</label>
                <input type="date" class="form-control" name="endDate" id="endDate">
            </div>

            <input class="btn btn-primary" type="submit" name="getNotes" id="getNotes" value="Get Notes">
            <br><br>

            <div class="form-group">

                <?php echo $notes;  ?>

            </div>

        </form>

    </div>
</body>

</html>