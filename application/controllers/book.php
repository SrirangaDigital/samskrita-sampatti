<?php

class book extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	//short for view
	public function v($query = [], $id = '') {

		if(!$id) $this->view('error/index');

		$url = API_URL . 'book/?id=' . $id;
		$data = $this->model->getDataFromApi($url);
		$data = json_decode($data, true);
		$data = $data[0];

		if(!$data) $this->view('error/index');

		$this->view('book/view', $data);
	}

	public function list($query = []) {

		$url = API_URL . 'book?' . $this->model->filterArrayToString($query);
		$data = $this->model->getDataFromApi($url);
		$data = json_decode($data, true);
		$data['category'] = (isset($query['details_collection_category'])) ? $query['details_collection_category'] : '';
		$this->view('book/list', $data);
	}
}

?>
