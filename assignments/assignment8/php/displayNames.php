<?php 
require '../classes/Pdo_methods.php';

$displayObject = new Display();
$names = $displayObject->displayNames();

class Display{

    function displayNames(){

        $pdo = new PdoMethods();

        $sql = "SELECT DISTINCT name FROM names ORDER BY name ASC";
        $records = $pdo->selectNotBinded($sql);

        //return $records;  // returns [object Object],[object, object],...
        //$recordsObj = json_encode($records); // Don't want to encode, just to decode again!

        return $this->getString($records);
    }
             // Loops thru JSON object, creates and returns a long string.
    function getString($json){ 
        
        $i = 0;
        $nameArrList = "";

        while($i < count($json)){
            $nameArrList .= $json[$i]['name']."\n";
            $i += 1;
        }

        return $nameArrList;
    }

} // class Display


 // If there is an error, then do

$response = (object)[
    'masterstatus' => 'error',
    'msg'=>"There was a problem"
];


$response = (object)[
    'masterstatus'=>'success',
    'names'=>$names
];

echo json_encode($response);

?>