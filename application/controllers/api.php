<?php

class api extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function book($query = [], $id = '') {

		$db = $this->model->db->useDB();
		$collection = $this->model->db->selectCollection($db, BOOKS_COLLECTION);

		$details = $this->model->getBookDetails($id, $collection);

		header('Content-Type: application/json');
		http_response_code(200);
		echo $details;
	}
}

?>