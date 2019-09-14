<?php

class search extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function index($query = []) {
		
		$data = [];
		$data = $this->model->getCategories('feature');
		$this->view('search/index', $data);
	}
}
?>
