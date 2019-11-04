<?php

class apiModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getBookDetails($query, $collection) {
		//var_dump($query); exit(0);
		$filter = [];
		$filter = $this->reformFilter($query);
		$iterator = $collection->find($filter);
		$data = [];
		foreach ($iterator as $row) {
			$row['cover'] = (file_exists(PHY_BOOKS_METADATA_URL . $row['id'] . '/cover.jpg')) ? BOOKS_METADATA_URL . $row['id'] . '/cover.jpg' : DEFAULT_COVER_IMAGE;
			// Summary
			$row['summary'] = (file_exists(PHY_BOOKS_METADATA_URL . $row['id'] . '/summary.html')) ? file_get_contents(PHY_BOOKS_METADATA_URL . $row['id'] . '/summary.html') : '';
			// Table of contents
			$row['contents'] = (file_exists(PHY_BOOKS_METADATA_URL . $row['id'] . '/contents.html')) ? file_get_contents(PHY_BOOKS_METADATA_URL . $row['id'] . '/contents.html') : '';

			$data[] = $row;
		}

		return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	}

	public function getBookTitle($query, $collection) {
		$filter = [];
		$filter = $this->reformFilter($query);
		$iterator = $collection->find($filter);
		$data = [];
		foreach ($iterator as $row) {
			$data[] = $row;
		}
		return $data[0]['details']['title'];
	}

	public function getDistinct($param, $filter) {

		$db = $this->db->useDB();
		$collection = $this->db->selectCollection($db, JOURNALS_COLLECTION);
		$reformedFilter = $this->reformFilter($filter);

		$match = ['$match' => $this->preProcessQueryFilter($reformedFilter)];
		$aggregatePipeline = [
				[ '$group' => [ '_id' => [ 'Param' => '$' . $param ], 'count' => [ '$sum' => 1 ]]],
				[ '$sort' => [ '_id' => 1 ] ],
				[ '$skip' => NO_SKIP ],
				[ '$limit' => NO_LIMIT ]
			];

		// Add match to aggregate pipeline only if filter is not null
		if ($reformedFilter) array_unshift($aggregatePipeline, $match);

		$iterator = $collection->aggregate($aggregatePipeline);

		$values = [];
		foreach ($iterator as $row) {

			$array = (array) $row['_id']['Param'];

			if ($reformedFilter) {

				$filterAgain = $reformedFilter; $filterAgain = array_pop($filterAgain); $filterAgain = array_pop($filterAgain);
				$array = array_filter($array, function ($element) use($filterAgain) { return preg_match('/' . $filterAgain . '/', $element); } );
			}

			foreach ($array as $elem) {

				$value['item'] = $elem;
				$value['count'] = $row['count'];

				if(array_search($elem, array_column($values, 'item')) === false) array_push($values, $value);
			}
		}
		asort($values);

		$data = ['param' => $param, 'values' => $values, 'filter' => $reformedFilter];

		return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	}

	public function getArticles($filter, $sort = '') {


		$db = $this->db->useDB();
		$collection = $this->db->selectCollection($db, JOURNALS_COLLECTION);

		$filter = $this->reformFilter($filter);

		$page = 1;
		if(isset($filter['lpage'])){

			$page = $filter['lpage'];
			unset($filter['lpage']);
		}

		$skip = ($page - 1) * PER_PAGE;

		$projection = [ 'projection' => ['_id' => 0], 'limit' => PER_PAGE, 'skip' => $skip];
		if($sort) $projection['sort'] = $this->reformSort($sort);
		$iterator = $collection->find($this->preProcessQueryFilter($filter), $projection);

		$articles = [];
		foreach ($iterator as $row) {

			$articles[] = $row;
		}

		$data = ['articles' => $articles, 'filter' => $filter, 'sort' => $sort];

		if(empty($articles))
			$data['articles'] = 'noData';

		return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	}

	public function getAlphabet() {

		$db = $this->db->useDB();
		$collection = $this->db->selectCollection($db, ALPHABET_COLLECTION);
		$result = $collection->findOne();
		unset($result['_id']);

		return json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	}

	public function reformSort($sort) {

		$values = explode(',', $sort);
		$reformedSort = [];
		foreach ($values as $value) {

			$key = preg_replace('/^\!/', '', $value);
			$value = (preg_match('/^\!/', $value)) ? -1 : 1;
			$reformedSort[$key] = $value;
		}

		return $reformedSort;
	}

	public function reformFilter($filter) {

		$reformedFilter = [];
		foreach ($filter as $key => $value) {

			// Values beginning with @ are treated as regular expressions
			if(preg_match('/^@/', $value)) {

				$value = ['$regex' => preg_replace('/^@/', '', $value)];
			}

			// Here _ in key is replaced with dot. PHP had initially done this change
			$reformedFilter{str_replace('_', '.', $key)} = $value;
		}

		return $reformedFilter;
	}
}

?>
