<?php

namespace Gpor\Famtree;

class GridCell extends GporBase
{
    /**
     * @var GridCellPlot
     */
    public $plot;

    /**
     * @var GridCellRecord
     */
    public $record;

    public function defaultTemplate()
    {
        return 'gridCell';
    }


}
