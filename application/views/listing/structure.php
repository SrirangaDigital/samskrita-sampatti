<?php
    $data = json_decode($data, true);
    $auxiliary = $data['values']['auxiliary'];
    unset($data['values']['auxiliary']);
?>

<div class="container dynamic-page">
    <div class="row">
        <div class="col-md-12">
            <h4 class="archiveTitle"><?=ARCHIVE?></h4>
            <h1 class="title"><?=$viewHelper->getStructurePageTitle($auxiliary['filter'])?></h1>
        </div>
    </div>
</div>
<div class="container-fluid dynamic-page gray-back pt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row gray-back">
            <?php foreach ($data['values'] as $row) { $filter = array_merge([$auxiliary['selectKey']=>$row['name']], $auxiliary['filter']); ?>
                <a href="<?=$row['nextURL']?>" class="col-6 col-md-2 archive-structure-pictorial">
                <?php if(ARCHIVE_STRUCTURE_TYPE == 'pictorial') { ?>
                    <div class="card sanskrit-english">
                        <img class="img-fluid" src="<?=$viewHelper->getCoverPage($filter)?>" alt="Cover page" />
                        <p><?=$viewHelper->getDisplayName([$auxiliary['selectKey']=>$row['name']])?></p>
                <?php } else { ?>
                    <div class="full-width-card red-edge">
                        <h3 class="author"><?=$row["name"]?></h3>
                <?php } ?>
                    </div>
                </a>    
            <?php } ?>
            </div>
        </div>
    </div>
</div>
