<?php

$numRows = 15;
$numCols = 5;

$output = "<table border='2' >";

for($row = 1; $row <= $numRows; $row++)
{
    $output .= "<tr>";
    
    for($col = 1; $col <= $numCols; $col++)
    {
        $output .= "<td>Row {$row} Cell {$col}</td>";
    }

    $output .= "</tr>";
}

$output .= "<table>";
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Exercise 3
        </title>
    </head>
    <body>
<h3>
    Screenshot of table
</h3>

<?php echo $output; ?>
    </body>

</html>