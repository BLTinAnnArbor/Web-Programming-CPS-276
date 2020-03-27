<?php

class FileList{

    private $path;

    function __construct() {  }

    private function createList($records){
		$list = '<ol>';
		foreach ($records as $row){
			$list .= "<li> <a target='_blank' href = {$row['path']}>{$row['file_name']} </li>";
		}
		$list .= '</ol>';
		return $list;
    }


} // class FileList
