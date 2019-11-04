<?php
	session_start();
	// include("../../connect.php");
	// $year = $_GET["year"];
	// $month = $_GET["month"];
	// $qtext = $_GET["q"];
	// $stext  = $_GET["q"];
	// $texts = '';
	// $texts = preg_split("/ /", $qtext);
	// $textFilter = "";
	// $searchedPages = array_values(array_unique($_SESSION['sd'][$year.$month]));
	//
	// for($ic=0;$ic<sizeof($texts);$ic++)
	// {
	// 	$textFilter .= $texts[$ic] . "* ";
	// }
	// $db = @new mysqli('localhost', "$user", "$password", "$database");
	// $db->set_charset("utf8");


	// for($a=0;$a<count($searchedPages);$a++)
	// {
	// 	$query1 = "SELECT * FROM
	// 					(SELECT * FROM
	// 						(SELECT * FROM
	// 							(SELECT * FROM word WHERE MATCH (word) AGAINST ('$textFilter' IN BOOLEAN MODE)) AS tb1
	// 						WHERE year = $year) as tb2
	// 					WHERE month = $month) as tb3
	// 				WHERE pagenum = $searchedPages[$a]";
	//
	// 	$result1 = $db->query($query1);
	// 	$num_rows1 = $result1->num_rows;
	// 	$cord = array();
	// 	$array = "";
	//
	// 	for($b = 0; $b < $num_rows1; $b++)
	// 	{
	// 		$row1=$result1->fetch_assoc();
	// 		$cord[] = array("l" => $row1['l'],"b" => $row1["b"],"r" => $row1["r"],"t" => $row1["t"]);
	// 	}
	// 	$row1["text"] = "Text Found in";
	// 	$qtext = "Text";
	// 	$row1["text"] = preg_replace("/Text/" , "{{{".$qtext."}}}" , $row1["text"]);
	// 	$array["text"] = $row1["text"];
	// 	$array["par"][] = array( "page" => $row1["pagenum"] , "boxes" => $cord);
	// 	$sd["matches"][] = $array;
	// }
	//echo json_encode($sd);
	$book_id = "book_" . $_GET["bookID"];
	$searchText = $_GET["q"];
	$query['q'] = "word:" . $searchText . " AND " . "pageid:" . $book_id;
	$filterString = filterArrayToString($query);
	$url = 'http://localhost:8983/solr/' . 'samskruthaSampathiWords/select?' . $filterString;
	$result = json_decode(getDataFromApi($url), true);
	$foundNumber = $result['response']['numFound'];
	//var_dump($result['response']['docs']); exit(0);
	if($foundNumber > 0) {
		$query['rows'] = $foundNumber;
		$filterString = filterArrayToString($query);
		$url = 'http://localhost:8983/solr/' . 'samskruthaSampathiWords/select?' . $filterString;
		$result = json_decode(getDataFromApi($url), true);
	for($i=0;$i<$foundNumber;$i++) {
		//$cord[] = array("l" => $row1['l'],"b" => $row1["b"],"r" => $row1["r"],"t" => $row1["t"]);
			$data = $result['response']['docs'][$i];
			$cord = array();
			$width = (int)preg_split('/\|/',$data['dimensions'][0])[0];
			$height = (int)preg_split('/\|/',$data['dimensions'][0])[1];
			$left = ($data['bbox.l'][0]/$width) * 800;
			$top = ($data['bbox.t'][0]/$height) * 1200;
			$right = ($data['bbox.r'][0]/$width) * 800;
			$bottom = ($data['bbox.b'][0]/$height) * 1200;
			$cord[] = array("l" => $left,"b" => $bottom,"r" => $right,"t" => $top);
			$pagenum = preg_split('/\|/',$data['pageid'][0])[1];
			$pagenum = str_pad($pagenum, 4, "0", STR_PAD_LEFT);
			$row1["text"] = "Text Found in";
			$qtext = "Text";
			$row1["text"] = preg_replace("/Text/" , "{{{".$qtext."}}}" , $row1["text"]);
			$array["text"] = $row1["text"];
			$array["par"] = array();
			$array["par"][] = array( "page" => $pagenum , "boxes" => $cord);
			$sd["matches"][] = $array;
		}
	}

	echo json_encode($sd);

	function filterArrayToString($filter){

		$urlFilterArray = [];
		foreach ($filter as $key => $value) {

			array_push($urlFilterArray, $key . '=' . filterSpecialChars($value));
		}
		$urlFilter = implode('&', $urlFilterArray);

		return $urlFilter;
	}

	function filterSpecialChars($string){

		//$string = str_replace('_', '.', $string);
		$string = urlencode($string);

		return $string;
	}

	function getDataFromApi($url){
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}
?>
