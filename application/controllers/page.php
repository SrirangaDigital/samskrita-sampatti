<?php

class page extends Controller {

	public function __construct() {

		parent::__construct();
	}

	public function index() {
		$this->view('flat/Home/index');
	}

	public function flat() {

		$args = func_get_args();

		// Last item in the array contains url filter elements. This need to be removed as currently for page/flat, they are not used
		$args = array_filter($args);
		if($args[1] == 'Home') {
			$data = $this->model->countAllItems();
			$path = 'flat/' . implode('/', $args);
			$this->view($path,$data);
		} else {
			$path = 'flat/' . implode('/', $args);
			$this->view($path);
		}
	}

	public function countBooks($query) {
		$url = API_URL . 'book?' . $this->model->filterArrayToString($query);
		$data = $this->model->getDataFromApi($url);
		$data = json_decode($data, true);
		return sizeof($data);
	}
}

?>
