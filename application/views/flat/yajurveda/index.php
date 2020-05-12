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
            <h1 class="title">Yajurveda</h1>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class ="row">
            <div class="col-md-12">
            <h4>बुद्धिमालिन्यहेतुत्वात तद्यजुः कृष्णमीर्यते | </br> व्यवस्थितप्रकरणं तद्यजुः शुक्लमीर्यते ||</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div id="cd-sec-nav">
                <nav id="cd-sec-main-nav">
                    <ul>
                        <li><i class="fa fa-book-open"></i> Shukla Yajurveda</li>
                        <li><a class="titles" href="<?=BASE_URL?>book/list?details.collection.category=Veda%20Vedanga&details.collection.veda=Yajurveda"><i class="fa fa-book-open"></i> Krishna Yajurveda</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<div id="loader-icon">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><br />
    Loading more items
</div>
