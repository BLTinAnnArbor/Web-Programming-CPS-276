<?php

class Upload{

    private $error;
    private $fileName;
    private $fileSize;
    private $fileType;

    function __construct() {

        $this->fileSize = $_FILES["selectedFile"]["size"]; 
        $this->fileType = $_FILES["selectedFile"]["type"];
        $this->fileName = $_FILES["selectedFile"]["name"];
    }

    function checkFile(){
        /*
        if($_FILES["selectedFile"]["size"] > 10000){
            return "File is too big.";
        }else{
            return "File size is okay.";
        }
        */
        return "File Size is: {$this->fileSize}";
    }

} // class Upload





?>