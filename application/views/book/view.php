<div class="container">
	<div class="row">
		<div class="col-md-4">
			<img src="<?=$data['cover']?>" alt="cover page" />
		</div>
		<div class="col-md-8">
			<h1><?=$data['details']['title']?></h1>
			<h2><?=$data['details']['contributors']['author']?></h2>
			<h4><?=$data['details']['collection'][0]['name']?> - <?=$data['details']['collection'][0]['index']?></h4>

			<div>
				<?php if($data['contents']) echo '<span>TOC</span>'; ?>
				<?php if($data['summary']) echo '<span>Summary</span>'; ?>
				<?php if($data['media']['pdf']['link']) echo '<span>PDF</span>'; ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<?php if($data['summary']) { ?>
			<div class="summary">
				<h3>Summary</h3>
				<div><?=$data['summary']?></div>
			</div>
			<?php } ?>
			<?php if($data['contents']) { ?>
			<div class="contents">
				<h3>Contents</h3>
				<div><?=$data['contents']?></div>
			</div>
			<?php } ?>
		</div>
		<div class="col-md-4">
			<div class="attributes">
				<h3>Attributes</h3>
				<?php foreach ($data['details']['attributes'] as $key => $value) echo '<span>' . ucwords($key) . ': ' . $value . '</span><br />'; ?>
			</div>
			<div class="related">
				<h3>Related books</h3>
				
			</div>
		</div>
	</div>
</div>