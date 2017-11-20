<?php /* @var $this \Gpor\Famtree\GridCell */ ?>
<?php if (isset($this->record)): ?>
    <?= $this->record ?>
<?php elseif (isset($this->plot)): ?>
    <?= $this->plot ?>
<?php else: ?>
<?php endif ?>