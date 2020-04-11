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

        if(isset($_POST['getNotes']) ){

            if(($_POST['begDate'] != "") && ($_POST['endDate'] != "")){
                return $this->getNotes();
            }
        }else{  return ""; }
    } 


    function addNote(){
        
        $ts = strtotime($_POST['dateTime']);
        $tsInt = (int)$ts;
        $note = $_POST['textInput'];

        $pdo = new PdoMethods();
    
        $sql = "INSERT INTO notes (my_timestamp, note_contents) VALUES (:tsInt, :note)";
            
        $bindings = [
            [':tsInt', $tsInt,'int'],
            [':note', $note,'str']
        ];
    
        $result = $pdo->otherBinded($sql, $bindings);
    
        if($result === 'error'){
             return 'There was an error adding the name';
        }else {
             return "The file has been added successfully.";
        }
      
    } // addNote()

   
    function getNotes(){
		
        $pdo = new PdoMethods();
        
        $begDateTStamp = strtotime($_POST['begDate']);

        $endDateTStamp = strtotime($_POST['endDate']);

        $sql = "SELECT my_timestamp, note_contents FROM notes 
        WHERE my_timestamp >= $begDateTStamp AND 
        my_timestamp <= $endDateTStamp
        ORDER BY my_timestamp";

		$records = $pdo->selectNotBinded($sql);

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

            $tsInt = $row['my_timestamp'];
            $ts = (string)$tsInt;
            $formattedDate = date("n/d/Y h:i a", $ts);

            $note = $row['note_contents'];
            $notes .= "<tr><td>{$formattedDate}</td><td>{$note}</td></tr>";
        }
        $notes .= '</table>';
        return $notes;
    }

} // class Date_time
