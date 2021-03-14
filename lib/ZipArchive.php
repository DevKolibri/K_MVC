<?php

namespace lib;


class ZipArchive{

	private static $archive = null;
	
	function __construct(){
		$this->archive = new ZipArchive();
	}

	 public function open_archive($file){

	 	$this->archive->open(__DIR__ . $file);
          $i = 0;
          $list = array();
            while($name = $this->archive->getNameIndex($i)) {
	         $list[$i] = $name;
	         $i++;
           }
 
          print_r($list);
            $this->archive->close();
              return $list;
	 }
}