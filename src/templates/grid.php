<?php /* @var $this \Gpor\Famtree\Grid */ ?>
<table class="gpor-famtree">
    <?php foreach ($this->rows as $row): /* @var $row \Gpor\Famtree\GridRow */ ?>
        <tr>
            <?php foreach ($row->cells as $cell): /* @var $cell \Gpor\Famtree\GridCell */ ?>
                <td>
                    <?= $cell ?>
                </td>
            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
</table>










