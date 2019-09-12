<script>
    $(document).ready(function(){

        $(window).scroll(function(){

            if ($(window).scrollTop() >= ($(document).height() - $(window).height()) * 0.75){

                if($('#grid').attr('data-go') == '1') {
                    var pagenum = parseInt($('#grid').attr('data-page')) + 1;
                    $('#grid').attr('data-page', pagenum);

                    var nextURL = window.location.href.replace(/[\?\&]+lpage=\d+/, '');
                    nextURL += (nextURL.match(/\?/)) ? '&lpage=' : '?lpage=';
                    nextURL += pagenum;

                    getresult(nextURL);
                }
            }
        });
    });     
</script>

<?php
    $data = json_decode($data, true);
    $searchTerm = "";
    if(isset($data['fullTextSearch'])) $searchTerm = $data['fullTextSearch'];
?>

<div class="container dynamic-page">
    <div class="row">
        <div class="col-md-12">
            <h4 class="archiveTitle"><?=ARCHIVE?></h4>
            <h1 class="title"><?=$data['pageTitle']?></h1>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div id="cd-sec-nav">
                <nav id="cd-sec-main-nav">
                    <ul>
                        <li><a class="years" href="<?=BASE_URL?>listing/journal"><i class="fa fa-book-open"></i> जर्नल्स</a></li>
                        <li><a class="years" href="<?=BASE_URL?>listing/structure/Journal?select=volume&journal=<?=$data['filter']['journal']?>"><i class="fas fa-calendar-alt"></i> <?=NAV_ARCHIVE_VOLUME?></a></li>
                        <li><a class="titles" href="<?=BASE_URL?>articles/all/<?=DEFAULT_LETTER?>?&journal=<?=$data['filter']['journal']?>"><i class="fas fa-copy"></i> <?=NAV_ARCHIVE_ARTICLES?></a></li>
                        <li><a class="authors" href="<?=BASE_URL?>listing/authors/<?=DEFAULT_LETTER?>?journal=<?=$data['filter']['journal']?>"><i class="fa fa-users"></i> <?=NAV_ARCHIVE_AUTHORS?></a></li>
                        <li><a class="features" href="<?=BASE_URL?>listing/category/feature?journal=<?=$data['filter']['journal']?>"><i class="fa fa-tags"></i> <?=NAV_ARCHIVE_FEATURES?></a></li>
                        <li><a class="search" href="<?=BASE_URL?>search/index"><i class="fa fa-search"></i> <?=NAV_ARCHIVE_SEARCH?></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div id="grid" class="container mainpage" data-page="1" data-go="1">
    <div class="row justify-content-center">
        <?php if(isset($data['alphabet'])) {?>
            <p class="col-md-7 alphabet">
                <?php foreach ($data['alphabet'] as $letter) { ?><a class="letter" href="<?=BASE_URL?>articles/all/<?=$letter?>?journal=<?=$data['filter']['journal']?>"><?=$letter?></a> <?php } ?>
            </p>
        <?php } ?>
    </div>
    <div class="row justify-content-center mainpage" id="posts">
        <?php foreach ($data['articles'] as $article) { ?>
            <div class="full-width-card col-md-5">
                <h4 class="publication-details">
                    <?php if(isset($article['feature'])) { ?><span class="orange"><a href="<?=BASE_URL?>articles/category/feature/<?=$article['feature']?>?journal=<?=$data['filter']['journal']?>"><?=$article['feature']?></a></span><?php } ?>
                    <?php if(isset($article['series'])) { ?><span class="brown"><a href="<?=BASE_URL?>articles/category/series/<?=$article['series']?>?journal=<?=$data['filter']['journal']?>"><?=$article['series']?></a></span><?php } ?>
                    <span class="maroon"><a href="<?=BASE_URL?>articles/toc?volume=<?=$article['volume']?>&issue=<?=$article['issue']?>&journal=<?=$data['filter']['journal']?>"><?=ISSUE?> <?=$viewHelper->getissueDevanagari($viewHelper->rlZero($article['issue']))?>,<?=VOLUME?> <?=$viewHelper->roman2Devnagari($viewHelper->rlZero($article['volume']))?> (<?=(isset($article['year']) && $article['year'] != '') ? $article['year']: ''?>, <?=(isset($article['month']) && $article['month'] != '') ? $article['month'] : ''?>)</a></span>
                </h4>
                <h2 class="title">
                    <a target="_blank" href="<?=BASE_URL?>bookreader/templates/journal.php?journalID=<?=$article['journalID']?>&volume=<?=$article['volume']?>&issue=<?=$article['issue']?>&pagenum=<?=preg_replace('/(.*?)\-(.*)/', "$1", $article['page'])?>" class="pdf"><?=$article['title']?></a>
                </h2>
                <?php if(isset($article['author'])) { ?>
                    <h3 class="author by">
                        <?php foreach($article['author'] as $author) { ?>
                            <span><a href="<?=BASE_URL?>articles/author/<?=$author['name']?>?journal=<?=$data['filter']['journal']?>"><?=$author['name']?></a></span>
                        <?php } ?>
                    </h3>
                <?php } ?>
                <?php if($article['media'] == 'html') { ?><div class="starred" title="Mobile friendly article"><i class="fa fa-star"></i></div><?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
<div id="loader-icon">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><br />
    Loading more items
</div>
