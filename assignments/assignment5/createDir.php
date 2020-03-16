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
            }else{
                $this->dirStatus = "A directory already exists with that name.";
            }

            chmod($path, 0777);

            try{

                $handle = fopen($path."/readme.txt", "w");
                fwrite($handle, $this->textInput);
                fclose($handle);
                $this->dirStatus = "File and directory were created.";

            }catch(Exception $e){

                $this->dirStatus = "File couldn't open correctly. Check spelling.";
            }

    } // mkDirAndFile()

} // class Directories

?>