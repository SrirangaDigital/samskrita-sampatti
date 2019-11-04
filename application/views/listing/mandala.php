<script type="text/javascript">
    var BASE_URL = '<?=BASE_URL?>';
    $(document).ready(function() {

        bindMandalaStructure();
    });
</script>
<div class="mandala-page">
  <h1>मण्डलवर्गीकरणम्</h1>
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-6 clear-paddings">
              <div class="structure-1">
                  <h2 class="lead">मण्डलसङ्ख्या</h2>
                  <ul class="list-inline">
  <?php
    $total = $data['total'];

    for($i=1;$i<=$total;$i++) {
      echo '<li class="mandala list-inline-item"><a data-mandala="' . $i . '" href="' . $i . '">' . $viewHelper->roman2dev($i) . '</a></li>' . "\n";
    }
  ?>
                  </ul>
              </div>
              <div class="structure-2">

              </div>
          </div>
      </div>
  </div>
</div>
