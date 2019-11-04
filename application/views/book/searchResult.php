
<?php
  $keys = array_keys($data['info']);
  //var_dump($data['info']); exit(0);
  //var_dump($keys);
  for($i=0;$i<count($keys);$i++) {
    $bookId[$keys[$i]] = preg_split('/\_/',$keys[$i])[1];
  }
?>

<div class="container dynamic-page">
    <div class="row">
        <div class="col-md-12">
            <h4 class="archiveTitle"><?=ARCHIVE?></h4>
            <h1 class="title"></h1>
        </div>
    </div>
</div>
<div id="grid" class="container mainpage" data-page="1" data-go="1">
    <div class="row justify-content-center mainpage" id="posts">
      <?php foreach ($keys as $key) { ?>
            <div class="full-width-card col-md-5">
                <h2 class="title">
                    <a target="_blank" href="<?=BASE_URL?>bookreader/templates/book.php?bookID=<?=$bookId[$key]?>&pagenum=0001&searchText=<?=$data['text']?>">Title: <?=$data['info'][$key]['titleInfo']?></a>
                </h2>
                <span class="downloadspan">Text match found at page(s) :</span>
                <span class="downloadspan"><a target="_blank" href="<?=BASE_URL?>bookreader/templates/book.php?bookID=<?=$bookId[$key]?>&pagenum=<?=$data['info'][$key]['pageInfo'][0]?>&searchText=<?=$data['text']?>"><?=sizeof($data['info'][$key]['pageInfo'])?></a></span>
            </div>
      <?php } ?>
    </div>
</div>
