<?php

class apiModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getBookDetails($id, $collection) {

		$filter = ['id' => $id];

		$iterator = $collection->findOne($filter);

		return json_encode($iterator, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	}
}

?>
