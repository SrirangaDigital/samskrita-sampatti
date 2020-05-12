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
                        <li><a class="years" href="<?=BASE_URL?>book/list?details.collection.category=Shastra"><i class="fa fa-book-open"></i>All Works</a></li>
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
            <?php foreach ($data['alphabet'] as $letter) { ?><a class="letter" href="<?=BASE_URL?>listing/shastra/details.title?details.collection.category=Shastra&details.title=@^"><?=$letter?></a> <?php } ?>
        </p>
    <?php } ?>
    </div>
    <div class="row justify-content-center">
    <?php foreach ($data['values'] as $row) { ?>
        <?php if(isset($row['item'])) { ?>
                <div class="full-width-card col-md-3">
                    <h3 class="item"><a href="<?=$data['nextUrl']?><?=$row['item']?>?shastra=<?=$data['filter']['sahithya']?>"><?=$row['item']?></a></h3>
                    <div class="param"><i class="fa <?=$icon?>"></i></div>
                </div>
        <?php } ?>
    <?php } ?>
    </div>
</div>
