<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 text-center">
			<h1>Books</h1>
		</div>
	</div>
	<div class="row justify-content-center">
		<?php foreach ($data as $row) { ?>
		<div class="col-md-3">
			<a href="<?=BASE_URL?>book/v/<?=$row['id']?>"><img src="<?=$row['cover']?>" alt="cover page" /></a><br />
			<h1><?=$row['details']['title']?></h1>
			<h2><?=$row['details']['contributors']['author']?></h2>
			<h4><?=$row['details']['collection'][0]['name']?> - <?=$row['details']['collection'][0]['index']?></h4>
		</div>
		<?php } ?>
	</div>
</div>