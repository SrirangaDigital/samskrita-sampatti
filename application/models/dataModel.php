<?php

class dataModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getFilesIteratively($dir, $pattern = '/*/'){

		$files = [];
	    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(rtrim($dir, "/")));
		$regex = new RegexIterator($iterator, $pattern, RecursiveRegexIterator::GET_MATCH);

	    foreach($regex as $file => $object) {
	        
			array_push($files, $file);
	    }

	    sort($files);
	    return ($files);
	}

	public function getDataFromFile($fileName) {

		$data = file_get_contents($fileName);
		$data = json_decode($data, true);

		return $data;
	}
}

?>
