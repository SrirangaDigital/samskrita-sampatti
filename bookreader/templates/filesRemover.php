<?php
	$jpg = 'find ../../public/data/jpg/1/ -mmin +10 -type f -name "*.jpg" -exec rm {} \;';
	exec($jpg);
	$tif = 'find ../../public/data/tif/ -mmin +10 -type f -name "*.tif" -exec rm {} \;';
	exec($tif);
?>
