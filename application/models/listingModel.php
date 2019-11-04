<?php

class listingModel extends Model {


	public function __construct() {

		parent::__construct();
	}

	public function getMandalaDetails($query) {
		$db= $this->db->useDB();
		$collection = $this->db->selectCollection($db, MANDALA_COLLECTION);
		if($query['type'] == 'mandala'){
			$iterator = $collection->find(array('id'=>$query['id']));
			$data['details'] = "mandala_details";

			foreach ($iterator as $row) {
				$data['total'] = $row['total'];
			}
			return $data;
		} else if ($query['type'] == 'sukta') {
			$iterator = $collection->find(array('id'=>$query['id']));
			$data['details'] = $query['idx'];

			foreach ($iterator as $row) {
				$data['total'] = $row['sukta'];
			}
			return $data;
		}

	}

	public function reformFilter($filter) {
		var_dump($query);
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
	public function getCategories($type, $selectKey, $filter = ''){

		$db = $this->db->useDB();
		$collection = $this->db->selectCollection($db, JOURNALS_COLLECTION);

		$skip = 0;
		$limit = NO_LIMIT;

		$match = $this->preProcessQueryFilter($filter);

		$iterator = $collection->aggregate(
				 [
					[ '$match' => $match ],
					[ '$group' => [ '_id' => [ 'Category' => '$' . $selectKey, 'Type' => '$Type', 'journalID' => '$journalID' ], 'count' => [ '$sum' => 1 ]]],
					[ '$sort' => [ '_id' => 1 ] ],
					[ '$skip' => $skip ],
					[ '$limit' => $limit ]
				]
			);

		$data = [];

		$precastSelectKeys = $this->getPrecastKey($type, 'selectKey');
		$selectKeyIndex = array_search($selectKey, $precastSelectKeys);
		$nextSelectKey = (isset($precastSelectKeys[$selectKeyIndex + 1])) ? $precastSelectKeys[$selectKeyIndex + 1] : false;

		$urlFilter = $this->filterArrayToString($filter);
		$urlFilter = ($urlFilter) ? '&' . $urlFilter : '';
		$auxiliary = ['parentType' => $type, 'selectKey' => $selectKey, 'filter' => $filter];

		foreach ($iterator as $row) {

			$category['name'] = (isset($row['_id']['Category'])) ? $row['_id']['Category'] : MISCELLANEOUS_NAME;
			$filter[$selectKey] = (isset($row['_id']['Category'])) ? $category['name'] : 'notExists';
			$category['nameURL'] = $this->filterSpecialChars($category['name']);
			$category['parentType'] = $row['_id']['Type'];
			$category['journalID'] = $row['_id']['journalID'];

            if(!(isset($row['_id']['Category'])))
            	$category['nameURL'] = 'notExists';

            if($nextSelectKey)
    			$category['nextURL'] = BASE_URL . 'listing/structure/' . $category['parentType'] . '/?select=' . $nextSelectKey . '&' . $selectKey . '=' . $category['nameURL'] . $urlFilter;
            else
                $category['nextURL'] = BASE_URL . 'articles/toc?' . $selectKey . '=' . $category['nameURL'] . $urlFilter;
            array_push($data, $category);
		}
		if($data){

			$data['auxiliary'] = $auxiliary;
		}

		// This marks the end of sifting through results

		return $data;
	}
}

?>
