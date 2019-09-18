<?php
    $data = json_decode($data, true);
    $auxiliary = $data['values']['auxiliary'];
    unset($data['values']['auxiliary']);
?>

<div class="container dynamic-page">
    <div class="row mb-2">
        <div class="col-md-12">
            <h4 class="archiveTitle"><?=ARCHIVE?></h4>
            <h1 class="title"><?=$viewHelper->getStructurePageTitle($auxiliary['filter'])?></h1>
        </div>
    </div>
    <div class="row justify-content-center">
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
<div class="container-fluid dynamic-page gray-back">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row gray-back">
            <?php foreach ($data['values'] as $row) { $filter = array_merge([$auxiliary['selectKey']=>$row['name']], $auxiliary['filter'], ['journalID' => $row['journalID']]); ?>
                <a href="<?=$row['nextURL']?>" class="col-6 col-md-2 archive-structure-pictorial">
                    <?php if(ARCHIVE_STRUCTURE_TYPE == 'pictorial') { ?>
                        <div class="card sanskrit-english">
                            <img class="img-fluid" src="<?=$viewHelper->getCoverPage($filter)?>" alt="Cover page" />
                            <p><?=$viewHelper->getDisplayName([$auxiliary['selectKey']=>$row['name']])?></p>
                        </div>
                    <?php } else { ?>
                    <div class="full-width-card red-edge">
                        <h3 class="author"><strong><?=$viewHelper->roman2Devnagari($row["name"]);?></strong></h3>
                    </div>
                    <?php } ?>
                </a>    
            <?php } ?>
            </div>
        </div>
    </div>
</div>
