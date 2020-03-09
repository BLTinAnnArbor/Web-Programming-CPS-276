<?php

class DisplayNames{
   
    private $fullName;
    private $firstLast;
    private $lastFirst;

    private $nameListArray = array();
    private $nameListString;
    private $localOutput;
    
    function addClearNames() 
    {
        if(isset($_POST['submitButton'])) {

            $this->fullName = $_POST['fullname'];

            $this->nameListString = $_POST['nameList'];
            $this->nameListString = rtrim($this->nameListString); // trims "\n"

            $this->formatName();
            $this->createAndSortArray();
            return $this->makeLongString();
            
        }else if(isset($_POST['clearButton'])) {
            return  "";
        }       
    } // addClearNames()

    function makeLongString(){ 
            foreach($this->nameListArray as $name){
                $this->localOutput.= $name."\n";
            }    
       return $this->localOutput;
    }

    function createAndSortArray(){
        $this->nameListArray = explode("\n", $this->nameListString); 
        array_push($this->nameListArray, $this->lastFirst);       
        sort($this->nameListArray);            
    }

    function formatName(){
        $this->firstLast = explode(" ", $this->fullName);
        $first = $this->firstLast[0];
        $last = $this->firstLast[1];
        $this->lastFirst = $last.", ".$first;
     }

} // class DisplayNames

?>