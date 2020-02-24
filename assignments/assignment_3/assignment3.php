
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
require_once "Calculator.php";

$ErrStr = "You must enter a string and two numbers. </br>";

$Calculator = new Calculator();

try{ echo $Calculator->calc("/", 10, 0);
}catch(ArgumentCountError $e){ echo $ErrStr; }

try{ echo $Calculator->calc("*", 10, 2);
}catch(ArgumentCountError $e){ echo $ErrStr; }

try{ echo $Calculator->calc("/", 10, 2);
}catch(ArgumentCountError $e){ echo $ErrStr; }

try{ echo $Calculator->calc("-", 10, 2);
}catch(ArgumentCountError $e){ echo $ErrStr; }

try{ echo $Calculator->calc("+", 10, 2);
}catch(ArgumentCountError $e){ echo $ErrStr; }

try{ echo $Calculator->calc("*", 10);
}catch(ArgumentCountError $e){ echo $ErrStr; }

try{ echo $Calculator->calc(10);
}catch(ArgumentCountError $e){ echo $ErrStr; }

?>

    </body>

</html>