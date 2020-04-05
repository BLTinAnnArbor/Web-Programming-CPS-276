<?php

require_once "classes/Crud.php";

class FileList{

    function createList(){

        $crud = new Crud();
        return $crud->getFiles();	
    }
} 

?>