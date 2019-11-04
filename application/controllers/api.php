<?php

class api extends Controller {

	public function __construct() {

		parent::__construct();
	}

	public function book($query = []) {
		$db = $this->model->db->useDB();
		$collection = $this->model->db->selectCollection($db, BOOKS_COLLECTION);
		$details = $this->model->getBookDetails($query, $collection);
		header('Content-Type: application/json');
		http_response_code(200);
		echo $details;
	}

	public function getBookDetails($query = []) {
		$db = $this->model->db->useDB();
		$collection = $this->model->db->selectCollection($db, BOOKS_COLLECTION);
		$details = $this->model->getBookTitle($query, $collection);
		header('Content-Type: application/json');
		http_response_code(200);
		echo $details;
	}

	public function distinct($query = [], $param = DEFAULT_PARAM) {

		$data = $this->model->getDistinct($param, $query);
		echo $data;
	}

	public function articles($query = []) {

		if (!isset($query['sort'])) $query['sort'] = '';
		$sort = $query['sort'];	unset($query['sort']);
		$data = $this->model->getArticles($query, $sort);
		echo $data;
	}

	// public function otherArticles($query = []) {

	// 	if (!isset($query['sort'])) $query['sort'] = '';
	// 	$sort = $query['sort'];	unset($query['sort']);
	// 	$data = $this->model->getArticles($query, $sort);
	// 	echo $data;
	// }

	public function alphabet() {
		echo $this->model->getAlphabet();
	}
}

?>
