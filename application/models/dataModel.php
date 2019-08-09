<?php

class dataModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getFilesIteratively($dir, $pattern = '/*/'){

		$files = [];
	    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(rtrim($dir, "/")));
		$regex = new RegexIterator($iterator, $pattern, RecursiveRegexIterator::GET_MATCH);

	    foreach($regex as $file => $object) {
	        
			array_push($files, $file);
	    }

	    sort($files);
	    return ($files);
	}

	public function getDataFromFile($fileName) {

		$data = file_get_contents($fileName);
		$data = json_decode($data, true);

		return $data;
	}

	public function insertJournalEntries($collection) {

		$titleAlphabet = [];
		$titleOtherAlphabet = [];
		$authorAlphabet = [];

		$jsonFiles = $this->getFilesIteratively(PHY_JOURNALS_METADATA_URL, $pattern = '/index.json$/i');

		foreach ($jsonFiles as $jsonFile) {

			$content = $this->getDataFromFile($jsonFile);

			foreach ($content['toc'] as $article) {

				$data = $content;
				$data['Type'] = 'Journal';
				if(isset($data['toc']))	unset($data['toc']);
				$data = $data + $article;
				$data['id'] = $data['id'] . '/' . $article['page'];
				$data = array_filter($data);
				$result = $collection->insertOne($data);

				// fetching initial letter from author
				if(isset($article['author'])) {

					foreach ($article['author'] as $author) 
					array_push($authorAlphabet, preg_replace('/(^.).*/u', '$1', $author['name']));
				}

				// fetching initial letter from title
				$char = preg_replace('/(^.).*/u', '$1', $article['title']);
				$charUnicodeValue = $this->getUnicodeValue($char);

				if(($charUnicodeValue >= $this->getUnicodeValue(UNICODE_START)) && ($charUnicodeValue <= $this->getUnicodeValue(UNICODE_END)))
					array_push($titleAlphabet, $char);
				else
					array_push($titleOtherAlphabet, $char);
			}
		}

		sort($titleAlphabet); sort($authorAlphabet); sort($titleOtherAlphabet);
		$this->insertAlphabet(array_unique($titleAlphabet), array_unique($authorAlphabet), array_unique($titleOtherAlphabet));
	}

	public function insertAlphabet($titleAlphabet, $authorAlphabet, $titleOtherAlphabet) {

		$data = [];
		$db = $this->db->useDB();
		$collection = $this->db->createCollection($db, ALPHABET_COLLECTION);
		$data['title'] = array_values($titleAlphabet);
		$data['author'] = array_values($authorAlphabet);
		$data['titleOther'] = array_values($titleOtherAlphabet);

		$result = $collection->insertOne($data);
	}
}

?>
