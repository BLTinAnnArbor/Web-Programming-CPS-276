<?php


class DisplayNames2 
{
    private $nameList;
    private $fullName;
    private $localOutput;
    
    function addClearNames() 
    {
        
        if(isset($_POST['submitButton'])) {
            $this->fullName = $_POST['fullname'];
            $this->nameList = $_POST['nameList'];

            if(!strlen($this->nameList)>0){ // If it has just been cleared
                $this->localOutput = $this->fullName;   
            }else{
                $this->localOutput = $this->nameList."\n".$this->fullName;
            }
            return $this->localOutput
            ;
        }else if(isset($_POST['clearButton'])) {
            return  "";
        }       
    }

} // class DisplayNames

?>