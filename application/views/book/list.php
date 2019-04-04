<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 text-center">
			<h1>Books</h1>
		</div>
	</div>
	<div class="row justify-content-around bookList">
		<?php foreach ($data as $row) { ?>
		<div class="col-md-5 card">
			<div class="row">
				<div class="col-md-4 coverpage">
					<a href="<?=BASE_URL?>book/v/<?=$row['id']?>"><img src="<?=$row['cover']?>" alt="cover page" /></a>
				</div>
				<div class="col-md-8 headblock">
					<h1 class="title"><?=$row['details']['title']?></h1>

					<?php foreach ($row['details']['contributors']['author'] as $author) echo '<h2 class="author">' . $author . '</h2>'; ?>

					<h4 class="collection">
						<span><?=$row['details']['collection'][0]['name']?></span>
					</h4>

					<div class="badges">
						<?php if($row['contents']) echo '<img src="' . PUBLIC_URL . 'images/stock/diagram.svg" alt="pdf" />'; ?>
						<?php if($row['summary']) echo '<img src="' . PUBLIC_URL . 'images/stock/document.svg" alt="pdf" />'; ?>
						<?php if($row['media']['pdf']['link']) echo '<img src="' . PUBLIC_URL . 'images/stock/pdf.svg" alt="pdf" />'; ?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>