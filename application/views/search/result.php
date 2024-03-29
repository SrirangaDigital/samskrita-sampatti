<?php $term = array_pop($data); ?>
<script>
$(document).ready(function(){

    $('.post.no-border').prepend('<div class="albumTitle Search"><span><i class="fa fa-search"></i> ' + '<?=$term?>' + '</span></div>');

    $(window).scroll(function(){

        if ($(window).scrollTop() >= ($(document).height() - $(window).height())* 0.75){

            if($('#grid').attr('data-go') == '1') {

                var pagenum = parseInt($('#grid').attr('data-page')) + 1;
                $('#grid').attr('data-page', pagenum);

                getresult(base_url + 'search/field/?page=' + pagenum + '&term=' + '<?=$term?>');
            }
        }
    });
});     
</script>

<div id="grid" class="container-fluid" data-page="1" data-go="1">
    <div id="posts">
        <div class="post no-border"></div>
<?php foreach ($data as $row) { ?>
        <div class="post">
            <a href="<?=BASE_URL?>describe/artefact/<?=$row['idURL']?>" title="View Details" target="_blank">
                <img src="<?=$row['thumbnailPath']?>">
                <p class="image-desc">
                    <?=$row['cardName']?>
                </p>
            </a>
        </div>
<?php } ?>
    </div>
</div>
<div id="loader-icon">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><br />
    Loading more items
</div>