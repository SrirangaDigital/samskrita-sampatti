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
    <script type="text/javascript" src="../static/BookReader/BookReader.js"></script>

    <?php
		$bookID = $_GET['bookID'];
		$page = $_GET['pagenum'].".jpg";

		if(isset($_GET['searchText']) && $_GET['searchText'] != "")
		{
			$search = $_GET['searchText'];
			$book["searchText"] = $search;
		}

		$imgurl = "../../public/data/books/jpg/2/" . $bookID . '/';
		$images = [];

		foreach (glob($imgurl . '*.jpg') as $filename) {
			array_push($images, preg_replace('/.*\/(.*?)\.jpg/', "$1.jpg", $filename));
		}

		$book['type'] = 'books';
		$book["imglist"]=array_values($images);
		$book["Title"] = "Samskrita Sampatti";
		$book["TotalPages"] = count($book["imglist"]);
		$book["SourceURL"] = "";
		$result = array_keys($book["imglist"], $page);
		$book["pagenum"] = $result[0];
		$book["bookID"] = $bookID;
		$book["imgurl"] = $imgurl;
		$book["bigImageUrl"] = "../../public/data/books/jpg/1/" . $bookID . '/';
    ?>
<script type="text/javascript">
	var book = <?php echo json_encode($book); ?>;
</script>
<script>
	$.ajax({url: "filesRemover.php", async: true});
</script>
</head>
<body style="background-color: #939598;">

<div id="BookReader">

</div>
<script type="text/javascript" src="../static/BookReaderJSSimple.js?v=1.0"></script>
</body>
</html>
