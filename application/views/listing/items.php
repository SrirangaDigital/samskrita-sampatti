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
</div>
<div class="container mainpage">
    <div class="row justify-content-center">
    <?php if(isset($data['alphabet'])) {?>
        <p class="col-md-7 alphabet">
            <?php foreach ($data['alphabet'] as $letter) { ?><a class="letter" href="<?=BASE_URL?>listing/authors/<?=$letter?>"><?=$letter?></a> <?php } ?>
        </p>
    <?php } ?>
    </div>
    <div class="row justify-content-center">
    <?php foreach ($data['values'] as $row) { ?>
        <?php if(isset($row['item'])) { ?>
                <div class="full-width-card col-md-3">
                    <h3 class="item"><a href="<?=$data['nextUrl']?><?=$row['item']?>"><?=$row['item']?></a></h3>
                    <div class="param"><i class="fa <?=$icon?>"></i></div>
                </div>
        <?php } ?>
    <?php } ?>
    </div>
</div>
