<?php
class Calculator{
    
    public function calc ($operator, $op1, $op2){

        if(!is_int($op1) || !is_int($op2) ){ // Checks for integers
            return "<p>A non-integer was entered. </p>";
        }

        switch ($operator) {
            case "+":
                $res = $op1 + $op2;
                $resStr = "sum";
            break;
            case "-":
                $res = $op1 - $op2;
                $resStr = "difference";
            break;
            case "*":
                $res = $op1 * $op2;
                $resStr = "product";
            break;
            case "/":
                if(!$op2 == 0){
                    $res = $op1 / $op2;
                    $resStr = "division";
                }else{
                    return "<p>Cannot divide by zero.</p>";
                }
            break;
            default:
            return "<p>Invalid operator.</p>"; 
        }
        return "<p>The {$resStr} of the numbers is {$res}.</p>";

    }
}

?>