<?php

class listingModel extends Model {


	public function __construct() {

		parent::__construct();
	}

	public function getCategories($type, $selectKey, $filter = ''){

		$db = $this->db->useDB();
		$collection = $this->db->selectCollection($db, ARTEFACT_COLLECTION);

		$skip = 0;
		$limit = NO_LIMIT;

		$matchFilter = $this->preProcessQueryFilter($filter);
		$match = [ 'Type' => $type ] + $matchFilter;

		$iterator = $collection->aggregate(
				 [
					[ '$match' => $match ],
					[ '$group' => [ '_id' => [ 'Category' => '$' . $selectKey, 'Type' => '$Type' ], 'count' => [ '$sum' => 1 ]]],
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
			// $category['leafCount'] = $row['count'];
			
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
