<?php /* @var $this \Gpor\Famtree\GridCellRecord */ ?>
<div class="gfam-grid-cell-record">
    <p class="name"><?= $this->name ?></p>
    <p class="type"><?= ucfirst($this->rel_type) ?>, DOB: <?= (isset($this->record->birthday)? date('d/m/Y', strtotime($this->record->birthday)) : '') ?></p>
</div>





