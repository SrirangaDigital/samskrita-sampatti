<?php
	$category = $data['category'];
	unset($data['category'])
?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 text-center">
			<h4 class="title">Collection of <span class="maroon"><?=$category?></span> Books</h4>
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
					<a href="<?=BASE_URL?>book/v/<?=$row['id']?>"><h1 class="title"><?=$row['details']['title']?></h1></a>

					<?php foreach ($row['details']['contributors']['author'] as $author) echo '<h2 class="author">' . $author . '</h2>'; ?>

					<h4 class="collection">
						<?=$row['details']['collection'][0]['name']?>
					</h4>

					<div class="badges">
						<?php if($row['contents']) echo '<img src="' . PUBLIC_URL . 'images/stock/diagram.svg" alt="pdf" />'; ?>
						<?php if($row['summary']) echo '<img src="' . PUBLIC_URL . 'images/stock/document.svg" alt="pdf" />'; ?>
						<?php if($row['media']['pdf']['link']) echo '<a href="' . PUBLIC_URL . 'data/books/pdf/' . $row['id'] . '/index.pdf" target="_blank"><img src="' . PUBLIC_URL . 'images/stock/pdf.svg" alt="pdf" /></a>'; ?>
						<a href="<?=BASE_URL?>bookreader/templates/book.php?bookID=<?=$row['id']?>&pagenum=0001" target="_blank"><img src="<?=PUBLIC_URL?>images/stock/logo1.png" alt="Bookreader" /></a>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>