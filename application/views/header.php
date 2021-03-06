<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131828791-1"></script>
	<script type="text/javascript">
		var base_url = "<?= BASE_URL?>";
		var nav_archive_volume = "<?=VOLUME?>";
		var nav_archive_issue = "<?=ISSUE?>";
	</script>
	<!-- Basic Page Needs
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<meta charset="utf-8">
	<title><?php if($pageTitle) echo $pageTitle . ' | '; ?>Samskrita Sampatti</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- FONT
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,300i|Playfair+Display:700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Laila:300,400,500,600,700|Martel:200,300,400,600,700,800,900&amp;subset=devanagari" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Halant:400,600,700&amp;subset=devanagari" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900" rel="stylesheet">

	<?php require_once('public/css/variables.css.php');?>

	<!-- Javascript calls
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<!-- <script type="text/javascript" src="<?=PUBLIC_URL?>js/common.js?v=1.0.0"></script> -->
	 <script type="text/javascript" src="<?=PUBLIC_URL?>js/common.js"></script>
	<script type="text/javascript" src="<?=PUBLIC_URL?>js/main.js"></script>

	<!-- CSS
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="<?=PUBLIC_URL?>css/navbar.css?v=1.0">
	<link rel="stylesheet" href="<?=PUBLIC_URL?>css/secondary-navbar.css?v=2.0">
	<link rel="stylesheet" href="<?=PUBLIC_URL?>css/home.css?v=1.0">
	<link rel="stylesheet" href="<?=PUBLIC_URL?>css/mandala.css">
	<link rel="stylesheet" href="<?=PUBLIC_URL?>css/page.css?v=1.1">
	<link rel="stylesheet" href="<?=PUBLIC_URL?>css/book.css?v=1.0">
	<link rel="stylesheet" href="<?=PUBLIC_URL?>css/archive.css?v=1.0">
	<link rel="stylesheet" href="<?=PUBLIC_URL?>css/general.css?v=1.0">

	<!-- Favicon
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="icon" type="image/png" href="<?=PUBLIC_URL?>images/favicon.png">
</head>
<body>
	<header id="header">
		<!-- Navigation
		–––––––––––––––––––––––––––––––––––––––––––––––––– -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">
				<img src="<?=PUBLIC_URL?>images/logoText.png" alt="Logo of Samskrita Sampatti">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbar-nav">
				<?=$this->printNavigation($navigation)?>
				<div class="login"><i class="fas fa-user"></i></div>
			</div>
		</nav>
		<!-- End Navigation
		–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	</header>
</body>
