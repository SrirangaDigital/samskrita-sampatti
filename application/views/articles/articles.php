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

<?php $data = json_decode($data, true);
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
</div>
<div id="grid" class="container" data-page="1" data-go="1">
    <div class="row justify-content-center">
    <?php if(isset($data['alphabet'])) {?>
        <p class="col-md-7 alphabet">
            <?php foreach ($data['alphabet'] as $letter) { ?><a class="letter" href="<?=BASE_URL?>articles/all/<?=$letter?>"><?=$letter?></a> <?php } ?>
        </p>
    <?php } ?>
    </div>
    <div class="row justify-content-center mainpage" id="posts">
    <?php foreach ($data['articles'] as $article) { ?>
        <div class="full-width-card col-md-5">
            <h4 class="publication-details">
                <?php if(isset($article['feature'])) { ?><span class="orange"><a href="<?=BASE_URL?>articles/category/feature/<?=$article['feature']?>"><?=$article['feature']?></a></span><?php } ?>
                <?php if(isset($article['series'])) { ?><span class="brown"><a href="<?=BASE_URL?>articles/category/series/<?=$article['series']?>"><?=$article['series']?></a></span><?php } ?>
                <span class="maroon"><a href="<?=BASE_URL?>articles/toc?volume=<?=$article['volume']?>&issue=<?=$article['issue']?>"><?=$viewHelper->getissueDevanagari($article['issue'])?>, <?=$viewHelper->roman2Devnagari($viewHelper->rlZero($article['volume']))?> (<?=(isset($article['year']) && $article['year'] != '') ? $article['year']: ''?>, <?=(isset($article['month']) && $article['month'] != '') ? $article['month'] : ''?>)</a></span>
            </h4>
            <h2 class="title">
                <a target="_blank" href="<?=BASE_URL?>article/text/<?=$article['volume']?>/<?=$article['issue']?>/<?=$article['page']?>?search=<?=$searchTerm?>" class="pdf"><?=$article['title']?></a>
            </h2>
            <?php if(isset($article['author'])) { ?>
                <h3 class="author by">
                    <?php foreach($article['author'] as $author) { ?>
                        <span><a href="<?=BASE_URL?>articles/author/<?=$author['name']?>"><?=$author['name']?></a></span>
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
