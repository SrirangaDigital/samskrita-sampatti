<?php

class searchModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getCategories($param = DEFAULT_PARAM){

		$url = BASE_URL . 'api/distinct/' . $param;
		return json_decode($this->getDataFromApi($url), true);
	}
}
?>
