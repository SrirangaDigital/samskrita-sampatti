<?php

class apiModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getBookDetails($query, $collection) {

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
