<?php

$x = 4;
$y = 5;

$output = "<ul>";
for($i = 1; $i <= $x; $i++)
{
    $output .= "<li> $i </li>";
    $output .= "<ul>";
    for($j = 1; $j <= $y; $j++)
    {
        $output .= "<li> $j </li>";
    }
    $output .= "</ul>";
}
$output .= "</ul>";
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Exercise 1
        </title>
    </head>
    <body>
<h3>
    Nested Loop
</h3>

echo output$;
    </body>

</html>