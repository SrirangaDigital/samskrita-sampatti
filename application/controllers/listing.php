<?php

class listing extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function structure($query = [], $type = DEFAULT_TYPE) {

		// Get structural params from json-precast
		// listing/structure

		$query = $this->model->preProcessURLQuery($query);
		
		$query['select'] = (isset($query['select'])) ? $query['select'] : ''; $selectKey = $query['select']; unset($query['select']);

		$precastSelectKeys = $this->model->getPrecastKey($type, 'selectKey');

		if(array_search($selectKey, $precastSelectKeys) === false) {$this->view('error/index');return;}
		$categories['values'] = $this->model->getCategories($type, $selectKey, $query);
		($categories['values']) ? $this->view('listing/structure', json_encode($categories)) : $this->view('error/index');
	}

	public function articles() {

		// Redirect to articles/all/A
		// listing/articles
		$this->redirect('articles/all/' . DEFAULT_LETTER);
	}

	public function authors($query = [], $letter = DEFAULT_LETTER) {

		// Albhabetic list of authors displayed letter wise
		// listing/authors/A

		$filter = $this->model->filterArrayToString($query);
		$url = BASE_URL . 'api/distinct/author.name?' . $filter . '&author.name=@^' . $letter;

		$result = json_decode($this->model->getDataFromApi($url), true);
		$result['pageTitle'] = NAV_ARCHIVE_AUTHORS;
		$result['subTitle'] = AUTHOR;
		$result['nextUrl'] = BASE_URL . 'articles/author/';

		// getting alphabet list
		$url = BASE_URL . 'api/alphabet/';
		$result['alphabet'] = json_decode($this->model->getDataFromApi($url), true)['author'];

		($result['values']) ? $this->view('listing/items', json_encode($result)) : $this->view('error/index');
	}

	public function journal($query = [], $param = 'journal') {

		// Listing of various categories such as features and series
		// listing/category/feature

		$url = BASE_URL . 'api/distinct/' . $param;
		// $url = BASE_URL . 'api/distinct/' . $param . '?'  . $param . '=@^' . $letter;
		$result = json_decode($this->model->getDataFromApi($url), true);
		$result['nextUrl'] = BASE_URL . 'listing/structure/Journal?select=volume&journal=';

		($result['values']) ? $this->view('listing/journals', json_encode($result)) : $this->view('error/index');
	}

	public function category($query = [], $param = DEFAULT_PARAM) {

		// Listing of various categories such as features and series
		// listing/category/feature

		$filter = $this->model->filterArrayToString($query);
		$url = BASE_URL . 'api/distinct/' . $param . '?' . $filter . '&'. $param . '=@.*';

		$result = json_decode($this->model->getDataFromApi($url), true);
		$result['pageTitle'] = NAV_ARCHIVE_FEATURES;
		$result['nextUrl'] = BASE_URL . 'articles/category/' . $param . '/';

		($result['values']) ? $this->view('listing/items', json_encode($result)) : $this->view('error/index');
	}
}

?>
