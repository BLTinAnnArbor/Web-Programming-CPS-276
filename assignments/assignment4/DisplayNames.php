<?php

class DisplayNames {

    private $lastFirst;
    private $firstLast;
    private $fullName;

    function addClearNames() {
        
        if(isset($_POST['submitButton'])){
            //$this->format_and_add($_POST['fullname']);
            $this->fullName = $_POST['fullname'];
            return $this->formatName();

        }else if(isset($_POST['clearButton'])) {
            return  "Clear";
        }       
    }

    function formatName(){
       $this->firstLast = explode(" ", $this->fullName);
       $first = $this->firstLast[0];
       $last = $this->firstLast[1];
       $this->lastFirst = $last.", ".$first;
       return $this->lastFirst;

    }

    function addToList(){
        
        //return $this->nameList[0];
        return $this->sortAndDisplay();

    }

    function sortAndDisplay(){

        
    }

} // class DisplayNames

?>