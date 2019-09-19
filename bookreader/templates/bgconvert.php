<?php

	$type = $_GET['type'];
	$rootPath = '../../public/data/' . $type . '/';
	$index = $_GET['index'];
	$imgurl = $_GET['imgurl'];
	$reduce = round($_GET['level']);
	$book = $_POST['book'];
	$img = preg_split("/\./",$book[$index]);
	$mode = $_GET['mode'];
	$scale = 2100;

	if($type == 'books') {

		$bookID = $_GET['bookID'];
		$imgurl = $rootPath . "jpg/1/".$bookID;
		$djvurl = $rootPath . "djvu/".$bookID;
		$tifurl = $rootPath . "tif/".$bookID;
	}

	if($_GET['type'] == 'journals') {

		$journalID = $_GET['journalID'];
		$volume = $_GET['volume'];
		$issue = $_GET['issue'];
		$imgurl = $rootPath . "jpg/1/" . $journalID . '/' . $volume . '/' . $issue;
		$djvurl = $rootPath . "djvu/" . $journalID . '/' . $volume . '/' . $issue . '/';
		$tifurl = $rootPath . "tif/" . $journalID . '/' . $volume . '/' . $issue . '/';
	}

	if($reduce == 1)
	{
		if(!file_exists($tifurl."/".$img[0].".tif"))
		{
			$cmd = "ddjvu -format=tif ".$djvurl."/".$img[0].".djvu ".$tifurl."/".$img[0].".tif";
			exec($cmd);
		}
		if(!file_exists($imgurl."/".$img[0].".jpg"))
		{
			$cmd="convert $tifurl/".$img[0].".tif -resize x".$scale." $imgurl/".$img[0].".jpg";
			exec($cmd);
		}
	}
	$array['id'] = "#pagediv".$index;
	$array['mode'] = $mode;
	$array['img'] = $imgurl."/".$img[0].".jpg";
	
	echo json_encode($array, JSON_UNESCAPED_SLASHES);
	//~ Update manifest file to download the request file.
	// $myfile = fopen("appcache.manifest", "w") or die("Unable to open file!!!");
	// fwrite($myfile,"CACHE MANIFEST\n");
	// fwrite($myfile,$imgurl."/".$img[0].".jpg");
	// fwrite($myfile,"\n\nNETWORK:\n*\n");
	// fwrite($myfile,"FALLBACK:\n");
	// fclose($myfile);
?>
