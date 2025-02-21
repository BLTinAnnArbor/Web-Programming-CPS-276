<?php

require 'classes/Pdo_methods.php';

class DisplayRecords{

    function getResult(){
        
        return["Contact List", $this->getContacts()];
    }

function getContacts(){
		
    $pdo = new PdoMethods();

    $sql = "SELECT contact_name, address, city, state, phone, email, dob, contact_types, age_range FROM contacts";

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

    $contacts .= "<table><tr><th>Name</th><th>Address</th>";
    $contacts .= "<th>Phone</th><th>Email</th><th>Date of Birth</th><th>Contact</th><th>Age</th></tr>";

    foreach ($records as $row){

        $name = $row['contact_name'];
        $address = $row['address'];
        $city = $row['city'];
        $state = $row['state'];
        $phone = $row['phone'];
        $email = $row['email'];
        $dob = $row['dob'];
        $age = $row['age_range'];

        $contacts_string = $row['contact_types'];


        $contacts .= "<tr><td>{$name}</td><td>{$address}</td>";
        $contacts .="<td>{$phone}</td><td>{$email}</td><td>{$dob}</td><td>{$contacts_string}</td><td>{$age}</td></tr>";
    }
    $contacts .= '</div></table></form>';
    return $contacts;
}

} // class Contacts
