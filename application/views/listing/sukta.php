
<h2 class="lead">
    सूक्तसङ्ख्या <span class="prev-address">मण्डलम् <?=$viewHelper->roman2dev($data['details'])?></span>
</h2>
<ul class="list-inline">
<?php
for($i=1;$i<=$data['total'];$i++){

    echo '<li class="list-inline-item sukta"><a data-mandala="' . $data['details'] . '" data-sukta="' . $i . '" href="' . $i . '">' . $viewHelper->roman2dev($i) . '</a></li>' . "\n";
}
?>
</ul>
