<?php

require 'classes/Pdo_methods.php';

class DisplayRecords{

    function getResult(){
        
        return["Contact List", $this->getContacts()];
    }

function getContacts(){
		
    $pdo = new PdoMethods();

    $sql = "SELECT contact_name, address, city FROM contacts";

    $records = $pdo->selectNotBinded($sql);

    if($records == 'error'){
        return 'There has been an error processing your request.';
    }
    else {
        if(count($records) != 0){
            return $this->displayContacts($records);
        }
        else {
            return "No files were found.";
        }
    }
} // getContacts()


function displayContacts($records){

    $contacts = "<form method='post' action='index.php'><div class='form-group'>";

    $contacts .= "<table><tr><th>Name</th><th>Address</th><th>City</tr>";

    foreach ($records as $row){

        $name = $row['contact_name'];
        $address = $row['address'];
        $city = $row['city'];

        $contacts .= "<tr><td>{$name}</td><td>{$address}</td><td>{$city}</tr>";
    }
    $contacts .= '</div></table></form>';
    return $contacts;
}
} // class Contacts


/*

$output = "Hi There.";
$ack = "I'm the acknowledgment.";

// THIS IS A HEREDOC STRING WHICH CREATES THE FORM  
$form = <<<HTML
    <form method="post" action="index.php">
    <div class="form-group">

    echo $output; 
   
  </form>
HTML;

 HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON 
THE INDEX PAGE. */
//return [$ack, $form];

?>