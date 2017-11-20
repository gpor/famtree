<?php

namespace Gpor\Famtree;

class GridCellRecord extends GporBase
{
    public $name;
    public $rel_type;
    public $record;

    public function defaultTemplate()
    {
        return 'gridCellRecord';
    }
}
