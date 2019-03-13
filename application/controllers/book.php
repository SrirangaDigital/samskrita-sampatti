<?php

class book extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	//short for view
	public function v($query = [], $id = '') {

		if(!$id) $this->view('error/index');

		$url = API_URL . 'book/' . $id;
		$data = $this->model->getDataFromApi($url);

		if(!$data) $this->view('error/index');

		$this->view('book/view', $data);
	}
}

?>
