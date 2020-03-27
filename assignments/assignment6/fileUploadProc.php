<?php

require_once "Db_conn.php";
require_once "Pdo_methods.php";

class Upload{

    private $fileName;
    private $fileSize;

    private $fileType;
   
    function __construct() {

        $this->fileSize = $_FILES["selectedFile"]["size"]; 
        $this->fileType = $_FILES["selectedFile"]["type"];
        $this->fileName = $_FILES["selectedFile"]["name"];
    }

    function checkFile(){  
        
        if($this->fileSize > 100000){
            return "This file is too big.";
        }
        else if($this->fileType != "application/pdf"){
            return "File type is not okay. It must be a pdf file.";
        }else{
            return $this->moveFile();
        }
        
       // return "File Size is: {$this->fileSize}. File Type is {$this->fileType}";
    }

    function moveFile(){

        $fileName = $_POST['enteredFileName'];

        if(move_uploaded_file($_FILES["selectedFile"]["tmp_name"], "files/".$fileName)){

            // Insert things into table here- function call
            $this->fillTable();
            return "Your file was successfully uploaded.";
        }else{
            return "There was a problem uploading your file. Please try again.";
        }

    }

    function fillTable(){


    }

} // class Upload

?>