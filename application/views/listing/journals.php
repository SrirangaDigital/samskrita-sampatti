<?php
    $data = json_decode($data, true);
?>
<div class="container dynamic-page">
    <div class="row">
        <div class="col-md-12">
            <h4 class="archiveTitle"><?=MAIN_TITLE?></h4>
            <h1 class="title">List of Journals and Periodicals</h1>
        </div>
    </div>
</div>
<div class="container-fluid dynamic-page gray-back">
    <div class="row justify-content-around">
        <div class="col-md-8">
            <div class="row gray-back archive-structure-pictorial">
            <?php foreach ($data['values'] as $row) { ?>
                <a href="<?=$data['nextUrl']?><?=$row['item']?>" class="col-md-3 archive-structure-pictorial">
                    <div class="card sanskrit-english">
                        <img class="img-fluid" src="<?=PUBLIC_URL?>images/journals/<?=$row['item']?>.jpg" alt="Cover page" />
                        <h4 class="pt-3 collection"><span><?=$row['item']?></span></h4>
                    </div>
                </a>    
            <?php } ?>
            </div>
        </div>
    </div>
</div>
