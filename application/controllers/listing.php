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
		(isset($query['journal']) && $query['journal'] != '') ? $categories['filter']['journal'] = $query['journal'] : '';
		($categories['values']) ? $this->view('listing/structure', json_encode($categories)) : $this->view('error/index');
	}

	public function articles() {

		// Redirect to articles/all/A
		// listing/articles
		$this->redirect('articles/all/' . DEFAULT_LETTER);
	}

	public function mandala() {
		$query = array('id'=>'m00','type'=>'mandala');
		$data = $this->model->getMandalaDetails($query);
		($data) ? $this->view('listing/mandala', $data) : $this->view('error/index');
	}


	public function sukta($query = array()) {

		$mandala = (isset($query['mandala'])) ? $this->buildMandalaId($query['mandala']) : DEFAULT_MANDALA;
		$query = array('id' => $mandala,'type'=>'sukta','idx'=>$query['mandala']);
		$data = $this->model->getMandalaDetails($query);
		// // $filterJSON = '{"mandala" : "' . $mandala . '"}';
		// // $data = $this->model->listDistinctAttribute('sukta', $filterJSON);
		($data) ? $this->getComponent('listing/sukta', $data) : $this->view('error/index');
	}

	function buildMandalaId($id) {
		switch($id) {
			case '1' : return("m01");
									break;
			case '2' : return("m02");
									break;
			case '3' : return("m03");
									break;
			case '4' : return("m04");
									break;
			case '5' : return("m05");
									break;
			case '6' : return("m06");
									break;
			case '7' : return("m07");
									break;
			case '8' : return("m08");
									break;
			case '9' : return("m09");
									break;
			case '10' : return("m10");
									break;
			default : return("m01");
									break;
		}
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


	public function sahithya($query = [], $letter = DEFAULT_LETTER) {

		// Albhabetic list of authors displayed letter wise
		// listing/authors/A
		$filter = $this->model->filterArrayToString($query);
		$url = BASE_URL . 'api/bookDistinct/details.contributors.author?' . $filter . '&details.contributors.author=@^' . $letter;

		$result = json_decode($this->model->getDataFromApi($url), true);
		$result['pageTitle'] = NAV_ARCHIVE_AUTHORS;
		$result['subTitle'] = AUTHOR;
		$result['nextUrl'] = BASE_URL . 'articles/author/';

		// getting alphabet list
		$url = BASE_URL . 'api/alphabet/';
		$result['alphabet'] = json_decode($this->model->getDataFromApi($url), true)['author'];

		($result['values']) ? $this->view('listing/sahithyaitem', json_encode($result)) : $this->view('error/index');
	}
	public function shastra($query = [], $letter = DEFAULT_LETTER) {

		// Albhabetic list of authors displayed letter wise
		// listing/authors/A
		$filter = $this->model->filterArrayToString($query);
		$url = BASE_URL . 'api/bookDistinct/details.contributors.author?' . $filter . '&details.contributors.author=@^' . $letter;

		$result = json_decode($this->model->getDataFromApi($url), true);
		$result['pageTitle'] = NAV_ARCHIVE_AUTHORS;
		$result['subTitle'] = AUTHOR;
		$result['nextUrl'] = BASE_URL . 'articles/author/';

		// getting alphabet list
		$url = BASE_URL . 'api/alphabet/';
		$result['alphabet'] = json_decode($this->model->getDataFromApi($url), true)['author'];

		($result['values']) ? $this->view('listing/shastraitem', json_encode($result)) : $this->view('error/index');
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
