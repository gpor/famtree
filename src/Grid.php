<?php

namespace Gpor\Famtree;

class Grid extends GporBase
{
    /**
     * @var GridRow[]
     */
    public $rows = [];
    
    public $leftEdge;
    public $rightEdge;
    public $topEdge;
    public $bottomEdge;

    public function defaultTemplate()
    {
        return 'grid';
    }

    public function cellPlot($x, $y, GridCellPlot $plot)
    {
        $this->rows[$y]->cells[$x]->plot = $plot;
        $this->checkEdges($x, $y);
    }

    public function cellRecord($x, $y, GridCellRecord $record)
    {
        $this->rows[$y]->cells[$x]->record = $record;
        $this->checkEdges($x, $y);
    }

    private function checkEdges($x, $y)
    {
        if ($this->leftEdge === null || $x < $this->leftEdge) {
            $this->leftEdge = $x;
        }
        if ($this->rightEdge === null || $x > $this->rightEdge) {
            $this->rightEdge = $x;
        }
        if ($this->topEdge === null || $y < $this->topEdge) {
            $this->topEdge = $y;
        }
        if ($this->bottomEdge === null || $y > $this->bottomEdge) {
            $this->bottomEdge = $y;
        }
    }

    public function crop()
    {
        $new_rows = [];
        foreach ($this->rows as $row) {
            $new_rows[] = $row->sidesCropped($this->leftEdge, $this->rightEdge);
        }
//        for ($i = $this->topEdge; $i <= $this->bottomEdge + 1; $i++) {
//            $new_rows[] = $this->rows[$i]->sidesCropped($this->leftEdge, $this->rightEdge);
//        }
        $this->rows = $new_rows;
    }
}









