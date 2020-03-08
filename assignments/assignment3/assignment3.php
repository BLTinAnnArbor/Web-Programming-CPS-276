<?php
require_once "Calculator.php";
$Calculator = new Calculator();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Assignment 3
        </title>

    </head>
    <body>
<h3>
    Calculator Class- assignment 3
</h3>

<?php
echo $Calculator->calc("/", 10, 0);
echo $Calculator->calc("*", 10, 2);
echo $Calculator->calc("/", 10, 2);
echo $Calculator->calc("-", 10, 2);
echo $Calculator->calc("+", 10, 2);
echo $Calculator->calc("*", 10);
echo $Calculator->calc(10);
?>
    </body>
</html>