<div class="container dynamic-page">
    <div class="row">
        <div class="col-md-12">
            <h4 class="archiveTitle"><?=ARCHIVE?></h4>
            <h1 class="title"><?=SEARCH?></h1>
        </div>
    </div>
</div>
<div class="container mainpage">
	<form class="searchForm" action="<?=BASE_URL?>articles/search" method="GET">
		<div class="row justify-content-around">
			<div class="col-md-6 mainpage">
				<p class="text-right english"><small>Press “Ctrl+g” to toggle between English and Sanskrit</small></p>
				<div class="form-group row">
					<label for="title" class="col-lg-3 col-form-label form-control-label"><?=SEARCH_ARTICLE?> : </label>
					<div class="col-md-9">
						<input name="title" id="title" onfocus="SetId('title')" class="form-control" type="text">
					</div>
				</div>
				<div class="form-group row">
					<label for="authornames" class="col-lg-3 col-form-label form-control-label"><?=SEARCH_AUTHOR?> : </label>
					<div class="col-md-9">
						<input name="author.name" id="author.name" onfocus="SetId('author.name')" class="form-control" type="text">
					</div>
				</div>
				<div class="form-group row">
					<label for="feature" class="col-lg-3 col-form-label form-control-label"><?=SEARCH_FEATURE?> : </label>
					<div class="col-md-9">
						<input name="feature" list="feature" type="text" class="form-control">
						<datalist id="feature">
<?php if(isset($data['values'])) { foreach ($data['values'] as $value) { ?>
							<option value="<?=$value['item']?>">
<?php } } ?>
						</datalist>
					</div>
				</div>
				<div class="form-group row">
					<label for="fulltext" class="col-lg-3 col-form-label form-control-label"><?=SEARCH_WORD?> : </label>
					<div class="col-md-9">
						<input name="fullText.text" id="fullext" onfocus="SetId('fullext')" class="form-control" type="text" placeholder="">
					</div>
				</div>
				<div class="row justify-content-around mt-5">
					<div class="col-md-5">
						<input name="submit" id="submit" class="form-control" type="submit" value="<?=SEARCH_SEARCH?>">
					</div>
					<div class="col-md-5">
						<input name="reset" id="reset" class="form-control" type="reset" value="<?=SEARCH_RESET?>">
					</div>
				</div>
			</div>
			<div class="col-md-5 mainpage">
				<?php include( PHY_BASE_URL . "application/views/sanskritKeybord.php"); ?>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="<?=PUBLIC_URL?>js/transliteration.I.js" charset="UTF-8"></script>
<link rel="stylesheet" href="<?=PUBLIC_URL?>css/transliteration.css">
<script type="text/javascript" src="<?=PUBLIC_URL?>js/devanagari_kbd.js" charset="UTF-8"></script>
<script type="text/javascript">

	function onLoad() {

	    var options = {
	      sourceLanguage: 'en',
	      destinationLanguage: ['sa'],
	      shortcutKey: 'ctrl+g',
	      transliterationEnabled: true
	    };
	    
	    var control = new google.elements.transliteration.TransliterationControl(options);
	    var ids = [ "title", "author.name", "feature", "fullext"];

	    control.makeTransliteratable(ids);
	}

    google.setOnLoadCallback(onLoad);

</script>