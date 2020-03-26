<?php

class Upload{

    private $fileName;
    private $fileSize;
    private $fileType;
    private $error;

    function __construct() {

        $this->fileSize = $_FILES["selectedFile"]["size"]; 
        $this->fileType = $_FILES["selectedFile"]["type"];
        $this->fileName = $_FILES["selectedFile"]["name"];
        $this->error = false;
    }

    function checkFile(){  
        if($this->fileSize > 1000000){
            return "File too big.";
        }
        else if($this->fileType != "application/pdf"){
            return "File not okay, it must be a pdf file.";
        }else{
            return $this->moveFile();
        }
        
        //return "File Size is: {$this->fileSize}. File Type is {$this->fileType}";
    }

    function checkIfError(){
        if($this->error = true){
            return true;
        }else{
            return false;
        }
    }

    function moveFile(){

        $fileName = $_POST['enteredFileName'];

        if(move_uploaded_file($_FILES["selectedFile"]["tmp_name"], 
        "files/".$fileName)){
            return "Your file was successfully uploaded.";
        }else{
            $this->error = true;  // necessary here??
            return "There was a problem uploading your file. Please try again.";
        }

    }

} // class Upload





?>