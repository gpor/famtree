<?php

namespace Gpor\Famtree;

class GridRow extends GporBase
{
    /**
     * @var GridCell[]
     */
    public $cells = [];

    public function sidesCropped($left, $right)
    {
        $this->cells = array_slice($this->cells, $left, ($right - $left + 1));
        return $this;
    }
}