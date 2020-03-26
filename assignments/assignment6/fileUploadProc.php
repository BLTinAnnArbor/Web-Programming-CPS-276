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
        
        if($this->fileType != "application/pdf"){
            return "File not okay, it must be a pdf file.";
            $this->error = true;
        }else{
            return "File is okay cuz its a pdf.";
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
        if(move_uploaded_file($_FILES["selectedFile"]["tmp_name"], 
        "files/brian.pdf")){
            return "Your file was successfully uploaded.";
        }else{
            $this->error = true;  // necessary here??
            return "There was a problem uploading your file. Please try again.";
        }

    }

} // class Upload





?>