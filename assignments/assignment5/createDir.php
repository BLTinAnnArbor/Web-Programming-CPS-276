<?php

class Directories{

    private $dirName;
    private $textInput;
    private $dirStatus;
    
    function __construct() {

        $this->dirName = $_POST['dirName'];
        $this->textInput = $_POST['textInput'];
        $this->dirStatus = "in Constructor";  
    }

    public function getDirStatus(){
        return $this->dirStatus;
    }
    
    public function mkDirAndFile() {
    
        $path = "directories/".$this->dirName;

        if(!file_exists($path)){
            mkdir($path);    
        }
        
        chmod($path, 0777);

        if(file_exists($path."/readme.txt")){
            $this->dirStatus = "A directory already does exist with that name.";
        }else{
            $this->dirStatus = "File and directory were created.";
        }

        try{
            $handle = fopen($path."/readme.txt", "w");
            fwrite($handle, $this->textInput);
            fclose($handle);

        }catch(Exception $e){
             $this->dirStatus = "File couldn't open correctly. Check spelling.";
        }

    } // mkDirAndFile()

} // class Directories

?>