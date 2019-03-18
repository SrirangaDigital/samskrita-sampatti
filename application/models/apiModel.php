<?php

class apiModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getBookDetails($id, $collection) {

		$filter = ($id) ? ['id' => $id] : [];

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
}

?>
