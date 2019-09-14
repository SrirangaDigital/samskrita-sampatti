<?php

class articles extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function all($query = [], $letter = DEFAULT_LETTER) {

		// Albhabetic list of article displayed letter wise
		// articles/all/A

		// Get data from api
		// get('api/articles?title=@^' . $letter)

		$page = 1;

		if(isset($query['lpage']))		
			$page = $query['lpage'];
		$filter = $this->model->filterArrayToString($query);

		$url = BASE_URL . 'api/articles?' . $filter . '&title=@^' . $letter . '&sort=title&lpage=' . $page;
		$result = json_decode($this->model->getDataFromApi($url), true);
		$result['pageTitle'] = ARTICLES;
		$url = BASE_URL . 'api/alphabet/';
		$result['alphabet'] = json_decode($this->model->getDataFromApi($url), true)['title'];

		if($page == '1')
			($result['articles'] != 'noData') ? $this->view('articles/articles', json_encode($result)) : $this->view('error/index');
		else
			echo json_encode($result);
	}

	public function toc($query = []) {

		// Table of contents. This accepts one or more structural parameters
		// articles/toc?volume=001&part=01
		// articles/toc?number=123

		// Get data from api
		// get('api/articles?volume=001&part=01)
		
		$page = 1;

		if(isset($query['lpage']))		
			$page = $query['lpage'];

		// Exclude विज्ञापिकाः
		$filter = $this->model->filterArrayToString($query);
		$url = BASE_URL . 'api/articles?' . $filter;
		$result = json_decode($this->model->getDataFromApi($url), true);
		
		$result['pageTitle'] = TOC . ' - ' . ARCHIVE_ISSUE . ' ' . $this->viewHelper->roman2Devnagari($this->viewHelper->rlZero($query['issue'])) . ', ' . ARCHIVE_VOLUME . ' ' . $this->viewHelper->roman2Devnagari($this->viewHelper->rlZero($query['volume']));
		
		if($page == '1')
			($result['articles'] != 'noData') ? $this->view('articles/articles', json_encode($result)) : $this->view('error/index');
		else
			echo json_encode($result);
	}

	public function author($query = [], $author = DEFAULT_STRING) {

		// Chronological list of article written by an author
		// articles/author/author1

		// Get data from api
		// get('api/articles?author=author1
		
		$page = 1;

		if(isset($query['lpage']))		
			$page = $query['lpage'];

		$filter = $this->model->filterArrayToString($query);

		$url = BASE_URL . 'api/articles?' . $filter . '&author.name=' . $this->model->filterSpecialChars($author) . '&lpage=' . $page;
		$result = json_decode($this->model->getDataFromApi($url), true);
		$result['pageTitle'] = AUTHOR . ' - ' . $author;

		if($page == '1')
			($result['articles'] != 'noData') ? $this->view('articles/articles', json_encode($result)) : $this->view('error/index');
		else
			echo json_encode($result);
	}

	public function category($query = [], $category = DEFAULT_STRING, $categoryValue = DEFAULT_STRING) {

		// Chronological list of article in a given category
		// articles/category/feature/Editorial

		// Get data from api
		// get('api/articles?feature=Editorial
		
		$page = 1;

		if(isset($query['lpage']))		
			$page = $query['lpage'];

		$filter = $this->model->filterArrayToString($query);
		$url = BASE_URL . 'api/articles?' . $filter . '&' . $category . '=' . $this->model->filterSpecialChars($categoryValue) . '&lpage=' . $page;
		// var_dump($url); return;
		$result = json_decode($this->model->getDataFromApi($url), true);
		$result['pageTitle'] = constant(strtoupper($category)) . ' - ' . $categoryValue;
		
		if($page == '1')
			($result['articles'] != 'noData') ? $this->view('articles/articles', json_encode($result)) : $this->view('error/index');
		else
			echo json_encode($result);
	}

	public function search($query = []) {

		// Chronological list of article served as search results
		// articles/search?title='value1'&author.name='value1'
		// Here while doing the api call, care is to be taken to invoke regular expression for each search term

		$query = array_filter($query); unset($query['submit']);

		$page = 1;

		if(isset($query['lpage']))		
			$page = $query['lpage'];


		foreach ($query as $key => $value){

			if($key != 'lpage')
				$query[$key] = '@' . $value;
		}

		$filterString = $this->model->filterArrayToString($query);
		$url = BASE_URL . 'api/articles?' . $filterString;
		// $result = json_decode($this->model->getDataFromApi($url), true);
		$result = json_decode($this->model->getDataFromApi($url), true);
		// var_dump($result);
		$result['pageTitle'] = SEARCH_RESULTS;
		$result['fullTextSearch'] = (isset($query['fullText_text']))? preg_replace('/^@/', '', $query['fullText_text']): false;

		if($page == '1')
			($result['articles'] != 'noData') ? $this->view('articles/searchResult', json_encode($result)) : $this->view('error/noResults');
		else
			echo json_encode($result);
	}

	// public function other($query = [], $letter = DEFAULT_LETTER) {

	// 	// Other Character list of article displayed letter wise
	// 	// articles/other/A

	// 	// Get data from api
	// 	// get('api/articles?title=@^' . $letter)

	// 	$url = BASE_URL . 'api/otherArticles?sort=title';
	// 	$result = json_decode($this->model->getDataFromApi($url), true);
	// 	$result['pageTitle'] = ARCHIVE . ' > ' . ARTICLES;
	// 	$url = BASE_URL . 'api/alphabet/';
	// 	$result['alphabet'] = json_decode($this->model->getDataFromApi($url), true)['title'];
	// 	($result) ? $this->view('articles/articles', json_encode($result)) : $this->view('error/index');
	// }
}

?>
