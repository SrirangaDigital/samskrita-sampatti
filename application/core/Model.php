<?php

class Model {

	public function __construct() {

		$this->db = new Database();
	}
	
	public function getPostData() {

		if (isset($_POST['submit'])) {

			unset($_POST['submit']);	
		}

		if(!array_filter($_POST)) {
		
			return false;
		}
		else {

			return array_filter(filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS));
		}
	}

	public function getDetailsFromJsonPath($path){

		$contentString = file_get_contents($path);
		$content = json_decode($contentString, true);

		return $content;
	}

	public function getPrecastKey($type, $key){

	    $structure = json_decode(file_get_contents(PHY_JSON_PRECAST_URL . 'archive-structure.json'), true);

		return (isset($structure{$type}['selectKey'])) ? $structure{$type}{$key} : '';
	}

	public function writeJsonToPath($data, $path) {

		$jsonString = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
		return (file_put_contents($path, $jsonString)) ? True : False;
	}

	public function replaceJsonDataInDB($collection, $data, $key, $value) {

		return $collection->replaceOne([ $key => $value ], $data);
	}

	public function getDataFromApi($url){

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);

		$result = curl_exec($curl);
		curl_close($curl);

		return $result;
	}

	public function preProcessQueryFilter($filter){

		foreach ($filter as $key => $value) {
			
			if($value == 'notExists')
				$filter{$key} = ['$exists' => false];
		}

		return $filter;
	}

	public function filterArrayToString($filter){

		$urlFilterArray = [];
		foreach ($filter as $key => $value) {
			
			array_push($urlFilterArray, $key . '=' . $this->filterSpecialChars($value));
		}
		$urlFilter = implode('&', $urlFilterArray);

		return $urlFilter;
	}

	public function filterSpecialChars($string){

		$string = str_replace('_', '.', $string);
		$string = urlencode($string);

		return $string;
	}

	public function preProcessURLQuery($filter){

		foreach ($filter as $key => $value) {
			
			$filter{$key} = str_replace('_', '/', $filter{$key});
		}

		return $filter;
	}

	public function getUnicodeValue($c){

	    if (ord($c{0}) >=0 && ord($c{0}) <= 127)
	        return ord($c{0});
	    if (ord($c{0}) >= 192 && ord($c{0}) <= 223)
	        return (ord($c{0})-192)*64 + (ord($c{1})-128);
	    if (ord($c{0}) >= 224 && ord($c{0}) <= 239)
	        return (ord($c{0})-224)*4096 + (ord($c{1})-128)*64 + (ord($c{2})-128);
	    if (ord($c{0}) >= 240 && ord($c{0}) <= 247)
	        return (ord($c{0})-240)*262144 + (ord($c{1})-128)*4096 + (ord($c{2})-128)*64 + (ord($c{3})-128);
	    if (ord($c{0}) >= 248 && ord($c{0}) <= 251)
	        return (ord($c{0})-248)*16777216 + (ord($c{1})-128)*262144 + (ord($c{2})-128)*4096 + (ord($c{3})-128)*64 + (ord($c{4})-128);
	    if (ord($c{0}) >= 252 && ord($c{0}) <= 253)
	        return (ord($c{0})-252)*1073741824 + (ord($c{1})-128)*16777216 + (ord($c{2})-128)*262144 + (ord($c{3})-128)*4096 + (ord($c{4})-128)*64 + (ord($c{5})-128);
	    if (ord($c{0}) >= 254 && ord($c{0}) <= 255)    //  error
	        return FALSE;

	    return 0;
	}
}

?>
