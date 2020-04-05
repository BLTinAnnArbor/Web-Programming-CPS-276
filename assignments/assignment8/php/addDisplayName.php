<?php
require_once '../classes/Pdo_methods.php';

//require_once 'displayNames.php';  // This line makes it error which
                   // must have something to do with the JavaScript. ?

$anObject = new AddNameClass();
$names = $anObject->addName();

class AddNameClass{

    private $enteredName;

    function __construct()
    {
        $dataObj = json_decode($_POST['data']);
        $this->enteredName = $dataObj->name;
    }

    function addName(){

        $tempArray = explode(" ", $this->enteredName);
        $name = "{$tempArray[1]}, {$tempArray[0]}";
        
        $pdo = new PdoMethods();

		// Create the sql statement and bind the parameter
		$sql = "INSERT INTO names (name) VALUES (:name)";
	    
        // This binding is injected into the sql statement in $pdo->otherBinded()
	    $bindings = [
			[':name', $name,'str']
		];

        $result = $pdo->otherBinded($sql, $bindings);

        if($result == 'noerror'){ // Now that the name is successfully added,
                              // I want to display all names in the table.

            //$displayObj = new Display();  // This strategy doesn't work 
            // because I can't require displayNames.php for the Display class.

            $pdo2 = new PdoMethods();

            $sql2 = "SELECT name FROM names ORDER BY name ASC";
            $records2 = $pdo2->selectNotBinded($sql2);

            return  $this->getString($records2);
            // return  $displayObj->getString($records2); // Is there a way to do this?

        }else{
            return "Error";
        }
        
        return $result;

    } // addName()

    function getString($json){ // loops thru JSON object and creates a long string.
        
        $i = 0;
        $nameArrList = "";

        while($i < count($json)){
            $nameArrList .= $json[$i]['name']."\n";
            $i += 1;
        }

        return $nameArrList;

    } // getString()

} // class AddName


 // If there is an error, then do this

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