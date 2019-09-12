<?php
    $data = json_decode($data, true);
    $icon = ($data['param'] == 'author.name') ? 'fa-user' : 'fa-tags';
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
<div class="container mainpage mt-5">
    <div class="row justify-content-center">
    <?php if(isset($data['alphabet'])) {?>
        <p class="col-md-7 alphabet">
            <?php foreach ($data['alphabet'] as $letter) { ?><a class="letter" href="<?=BASE_URL?>listing/authors/<?=$letter?>?journal=<?=$data['filter']['journal']?>"><?=$letter?></a> <?php } ?>
        </p>
    <?php } ?>
    </div>
    <div class="row justify-content-center">
    <?php foreach ($data['values'] as $row) { ?>
        <?php if(isset($row['item'])) { ?>
                <div class="full-width-card col-md-3">
                    <h3 class="item"><a href="<?=$data['nextUrl']?><?=$row['item']?>?journal=<?=$data['filter']['journal']?>"><?=$row['item']?></a></h3>
                    <div class="param"><i class="fa <?=$icon?>"></i></div>
                </div>
        <?php } ?>
    <?php } ?>
    </div>
</div>
