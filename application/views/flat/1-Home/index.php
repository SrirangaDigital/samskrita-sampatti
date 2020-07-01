<div class="container-fluid">
	<div class="row justify-content-end mb-4 slider slider-1">
		<div class="col-md-5">
			<p class="callout"> <br /> <br /><br /></p>
			<p class="description"><br/><br/></p>
		</div>
	</div>
</div>
<div class="container-fluid back-gray card-slider subjects">
	<div class="row justify-content-center mb-4">
		<div class="col-md-3">
<!--
			<h3 class="title">मुख्यविभागाः</h3>
-->
		</div>
	</div>
	<div class="row justify-content-center mb-5 card-deck">
		<a href="<?=BASE_URL?>book/list_veda" class="card col-md-3">
			<img src="<?=STOCK_IMAGE_URL?>scene-01.jpg" class="card-img-top" alt="वेदवेदाङ्ग">
			<div class="card-body">
				<h5 class="card-title">Veda Vedanga</h5>
				<p class="card-desc eng"><?=$data['veda_vedanga'] . " Books"?></p>
			</div>
		</a>
		<a href="<?=BASE_URL?>shastra" class="card col-md-3">
			<img src="<?=STOCK_IMAGE_URL?>scene-02.jpg" class="card-img-top" alt="षड्दर्शनानि">
			<div class="card-body">
				<h5 class="card-title">Shastra</h5>
				<p class="card-desc eng"><?=$data['shastra'] . " Books"?></p>
			</div>
		</a>
		<a href="<?=BASE_URL?>Puranam-itihasa" class="card col-md-3">
			<img src="<?=STOCK_IMAGE_URL?>scene-03.jpg" class="card-img-top" alt="पुराणं - इतिहासः">
			<div class="card-body">
				<h5 class="card-title">Puranam itihasaha</h5>
				<p class="card-desc eng"><?=$data['ithihasa_purana'] . " Books"?></p>
			</div>
		</a>
	</div>
	<div class="row justify-content-center mb-5 card-deck">
	<a href="<?=BASE_URL?>book/list?details.collection.category=Sahithya"" class="card col-md-3">
			<img src="<?=STOCK_IMAGE_URL?>scene-04.jpg" class="card-img-top" alt="साहित्य">
			<div class="card-body">
				<h5 class="card-title">Sahitya</h5>
				<p class="card-desc eng"><?=$data['sahithya'] . " Books"?></p>
			</div>
		</a>
		<a href="<?=BASE_URL?>listing/journal" class="card col-md-3">
			<img src="<?=STOCK_IMAGE_URL?>scene-01.jpg" class="card-img-top" alt="वेदवेदाङ्ग">
			<div class="card-body">
				<h5 class="card-title">Journals and Periodicals</h5>
				<p class="card-desc eng"><?= $data['journal'] . " Journals"?></p>
			</div>
		</a>
		<a href="<?=BASE_URL?>book/list?details.collection.category=Kosha" class="card col-md-3">
			<img src="<?=STOCK_IMAGE_URL?>scene-02.jpg" class="card-img-top" alt="षड्दर्शनानि">
			<div class="card-body">
				<h5 class="card-title">Kosha</h5>
				<p class="card-desc eng"><?=$data['kosha'] . " Books" ?></p>
			</div>
		</a>
	</div>
	<div class="row justify-content-center description">
		<div class="col-md-12">
			<p>
				<a href=""><span class="more">All Subjects</span></a>
				<a href=""><span class="more">Subject Hierarchy</span></a>
			</p>
		</div>
	</div>
</div>
<div class="container-fluid card-slider features">
	<div class="row justify-content-center mb-4">
		<div class="col-md-3">
			<h3 class="title eng">Features</h3>
		</div>
	</div>
	<div class="row justify-content-around mb-5 card-deck">
		<div class="card-small col-md-2">
			<img src="<?=STOCK_IMAGE_URL?>web.svg" class="card-img-top" alt="वेदवेदाङ्ग">
			<div class="card-body">
				<h5 class="card-title eng">Curated Collection</h5>
			</div>
		</div>
		<div class="card-small col-md-2">
			<img src="<?=STOCK_IMAGE_URL?>document.svg" class="card-img-top" alt="वेदवेदाङ्ग">
			<div class="card-body">
				<h5 class="card-title eng">Book Summary</h5>
			</div>
		</div>
		<div class="card-small col-md-2">
			<img src="<?=STOCK_IMAGE_URL?>diagram.svg" class="card-img-top" alt="साहित्य">
			<div class="card-body">
				<h5 class="card-title eng">Table of Contents</h5>
			</div>
		</div>
		<div class="card-small col-md-2">
			<img src="<?=STOCK_IMAGE_URL?>structure.svg" class="card-img-top" alt="साहित्य">
			<div class="card-body">
				<h5 class="card-title eng">Subject Hierarchy</h5>
			</div>
		</div>
		<div class="card-small col-md-2">
			<img src="<?=STOCK_IMAGE_URL?>library.svg" class="card-img-top" alt="साहित्य">
			<div class="card-body">
				<h5 class="card-title eng">Full-text Search</h5>
			</div>
		</div>
	</div>
</div>
