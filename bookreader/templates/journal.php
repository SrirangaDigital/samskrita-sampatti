<?php session_start();	?>
<!DOCTYPE HTML>
<html manifest="appcache.manifest">
<head>

    <title>$book['Title']</title>
    <meta charset="UTF-8"/>
    <link rel="shortcut icon" type="image/ico" href="../../images/logo.ico" />
    <link rel="stylesheet" type="text/css" href="../static/BookReader/BookReader.css?v=1.0"/>
    <script type="text/javascript" src="../static/BookReader/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript" src="../static/BookReader/dragscrollable.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.ui.ipad.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.bt.min.js"></script>
    <script type="text/javascript" src="../static/BookReader/BookReader.js?v=1.0"></script>
    
    <?php
    	$book = [];
		$journalID = $_GET['journalID'];
		$volume = $_GET['volume'];
		$issue = $_GET['issue'];
		$page = $_GET['pagenum'].".jpg";
		
		if(isset($_GET['searchText']) && $_GET['searchText'] != "")
		{
			$search = $_GET['searchText'];
			$book["searchText"] = $search;
		}
		
		$book["type"] = 'journals';
		$imgurl = "../../public/data/" . $book["type"] . "/jpg/2/" . $journalID . '/' . $volume . '/' . $issue . '/';
		$images = [];
		
		foreach (glob($imgurl . '*.jpg') as $filename) {
			array_push($images, preg_replace('/.*\/(.*?)\.jpg/', "$1.jpg", $filename));
		}
		
		$book["imglist"]=array_values($images);
		$book["Title"] = "Samskrita Sampatti";
		$book["TotalPages"] = count($book["imglist"]);
		$book["SourceURL"] = "";
		$result = array_keys($book["imglist"], $page);
		$book["journalID"] = $journalID;
		$book["volume"] = $volume;
		$book["issue"] = $issue;
		$book["journalID"] = $journalID;
		$book["pagenum"] = $result[0];
		$book["imgurl"] = $imgurl;
		$book["bigImageUrl"] = "../../public/data/" . $book["type"] . "/jpg/1/" . $journalID . '/' . $volume . '/' . $issue . '/';
    ?>
<script type="text/javascript">
	var book = <?php echo json_encode($book); ?>;
</script>
<script>
// $.ajax({url: "filesRemover.php", async: true});
</script>
</head>
<body style="background-color: #939598;">

<div id="BookReader">
    
</div>
<script type="text/javascript" src="../static/BookReaderJSSimple.js?v=1.0"></script>
</body>
</html>
