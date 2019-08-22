<?php

	$booksJPG = 'find ../../public/data/books/jpg/1/ -mmin +10 -type f -name "*.jpg" -exec rm {} \;';
	exec($booksJPG);
	$journalsJPG = 'find ../../public/data/journals/jpg/1/ -mmin +10 -type f -name "*.jpg" -exec rm {} \;';
	exec($journalsJPG);

	$booksTIF = 'find ../../public/data/books/tif/ -mmin +10 -type f -name "*.tif" -exec rm {} \;';
	exec($booksTIF);
	$journalsTIF = 'find ../../public/data/journals/tif/ -mmin +10 -type f -name "*.tif" -exec rm {} \;';
	exec($journalsTIF);

?>
