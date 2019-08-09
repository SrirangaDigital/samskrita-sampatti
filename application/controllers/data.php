<?php

class data extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function insert($query = []) {

		// Books Insertion
		$db = $this->model->db->useDB();
		$collection = $this->model->db->createCollection($db, BOOKS_COLLECTION);
		
		$files = $this->model->getFilesIteratively(PHY_BOOKS_METADATA_URL, $pattern = '/index.json$/i');

		foreach ($files as $file) {
			
			$data = $this->model->getDataFromFile($file);
			$result = $collection->insertOne($data);
		}

		// Journals Insertion
		$collection = '';
		$collection = $this->model->db->createCollection($db, JOURNALS_COLLECTION);
		$this->model->insertJournalEntries($collection);
	}
}

?>
