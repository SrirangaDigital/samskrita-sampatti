<div class="container book">
	<div class="row">
		<div class="col-md-3 coverpage">
			<img src="<?=$data['cover']?>" alt="cover page" />
		</div>
		<div class="col-md-8 headblock">
			<h1 class="title"><?=$data['details']['title']?></h1>

			<?php foreach ($data['details']['contributors']['author'] as $author) echo '<h2 class="author">' . $author . '</h2>'; ?>

			<h4 class="collection">
				<span><?=$data['details']['collection'][0]['name']?></span>
			</h4>

			<div class="badges">
				<?php if($data['contents']) echo '<img src="' . PUBLIC_URL . 'images/stock/bullet-list.svg" alt="pdf" />'; ?>
				<?php if($data['summary']) echo '<img src="' . PUBLIC_URL . 'images/stock/document.svg" alt="pdf" />'; ?>
				<?php if($data['media']['pdf']['link']) echo '<img src="' . PUBLIC_URL . 'images/stock/pdf.svg" alt="pdf" />'; ?>
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