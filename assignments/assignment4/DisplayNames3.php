<?php

class DisplayNames3{
   
    private $fullName;
    private $formattedName;
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

            $this->formatName();
            return $this->createArray();

            //$this->makeLongString();

            //return $this->localOutput;
            
        }else if(isset($_POST['clearButton'])) {
            return  "";
        }       
    } // addClearNames()

    function makeLongString(){ // has 3 or more names
            foreach($this->nameListArray as $name){
                $this->localOutput.= $name."\n";
            }
            // Trim the last ':' here ??
       return $this->localOutput;
    }

    function createArray(){ 
        if(strlen($this->nameListString)<1){
            return $this->lastFirst."\n";
        }elseif(substr_count($this->nameListString, "\n")>1){
            $this->nameListArray = explode("\n", $this->nameListString);
            $len = count($this->nameListArray);
            $this->nameListArray[$len-1] = $this->lastFirst;
            return $this->makeLongString();
        }else{   // only one name before this
            array_push($this->nameListArray, $this->lastFirst);
            return $this->nameListString.$this->lastFirst."\n";
        }
           
    }

    function formatName(){
        $this->firstLast = explode(" ", $this->fullName);
        $first = $this->firstLast[0];
        $last = $this->firstLast[1];
        $this->lastFirst = $last.", ".$first;
     }

} // class DisplayNames

?>