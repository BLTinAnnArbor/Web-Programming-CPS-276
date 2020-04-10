<?php

require_once 'PdoMethods.php';

class Date_time{

    function checkAddNote(){


         if(isset($_POST['addNote'])){

            //return "Add Note was pressed.";
            return $this->addNote();

         }else{  return ""; }
    }             

    function checkGetNotes(){

        if(isset($_POST['getNotes'])){
            //return "Get Notes was pressed.";
            return $this->getNotes();

        }else{  return ""; }
    } 

    function addNote(){
        
        $ts = strtotime($_POST['dateTime']);
        $note = $_POST['textInput'];

        $pdo2 = new PdoMethods();
    
        $sql2 = "INSERT INTO notes (my_timestamp, note_contents) VALUES (:ts, :note)";
            
        $bindings = [
            [':ts', $ts,'str'],
            [':note', $note,'str']
        ];
    
        // Calling otherBinded() from PdoMethods class
        $result = $pdo2->otherBinded($sql2, $bindings);
    
        // Using object $result to return 'successful' or 'error'.
        if($result === 'error'){
             return 'There was an error adding the name';
        }else {
             return "The file has been added successfully.";
        }
      
    } // addNote()

   
    function getNotes(){
		
		$pdo = new PdoMethods();

		$sql = "SELECT my_timestamp, note_contents FROM notes ORDER BY (int)my_timestamp";

		$records = $pdo->selectNotBinded($sql);

		// If error then display message
		if($records == 'error'){
			return 'There has been an error processing your request.';
		}
		else {
			if(count($records) != 0){
				return $this->displayNotes($records);
			}
			else {
				return "No files were found.";
			}
		}
	} // getNotes()

	
	function displayNotes($records){

		$notes = "<table><tr><th>Date and Time</th><th>Note</th></tr>";

		foreach ($records as $row){

            $ts = $row['my_timestamp'];
            //$formattedDate = date("n/d/Y h:i a", $ts);
            $tsInt = (int)$ts;

            $note = $row['note_contents'];
            //$notes .= "<tr><td>{$formattedDate}</td><td>{$note}</td></tr>";
            $notes .= "<tr><td>{$tsInt}</td><td>{$note}</td></tr>";
        }
        
        $notes .= '</table>';
        return $notes;
    }


} // class Date_time

?>