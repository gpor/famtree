<?php

namespace Gpor\Famtree;

class Factory
{
    static public function instance($data_from_controller)
    {
        $instance = new Data;
        $grid = self::newGrid();
        $instance->grid = $grid;
        foreach ($data_from_controller['children'] as $child) {
            switch ($child['rel_type']) {
                case 'parent':
                    $instance->parents[] = $child;
                    break;
                case 'sibling':
                    $instance->siblings[] = $child;
                    break;
                case 'partner':
                    $instance->partner = $child;
                    break;
                case 'child':
                    $instance->children[] = $child;
                    break;
            }
        }
        unset($data_from_controller['children']);
        $instance->clientData = $data_from_controller;
        self::plotAll($instance);
        return $instance;
    }

    const X_START = 10;
    const Y_START = 3;

    static public function newGrid()
    {
        $grid = new Grid;
        for ($i = 0; $i < self::Y_START * 2; $i++) {
            $grid->rows[] = self::newGridRow();
        }
        return $grid;
    }

    static public function newGridRow()
    {
        $gridRow = new GridRow;
        for ($i = 0; $i < self::X_START * 2; $i++) {
            $cell = self::newgridCell();
            $gridRow->cells[] = $cell;
        }
        return $gridRow;
    }

    static public function newgridCell()
    {
        return new GridCell;
    }

    static public function plotAll(Data $instance)
    {
        self::plotRelationship($instance, $instance->clientData['rel_type'], $instance->clientData, 0, 1);
        foreach ($instance->parents as $i => $record) {
            self::plotRelationship($instance, 'parent', $record, $i, count($instance->parents));
        }
        foreach ($instance->siblings as $i => $record) {
            self::plotRelationship($instance, 'sibling', $record, $i, count($instance->siblings));
        }
        if ($instance->partner !== null) self::plotRelationship($instance, 'partner', $instance->partner, 0, 1);
        foreach ($instance->children as $i => $record) {
            self::plotRelationship($instance, 'child', $record, $i, count($instance->children));
        }
        $instance->grid->crop();
    }

    static public function plotRelationship(Data $instance, $type, $record, $i, $n)
    {
        $x = self::X_START; $y = self::Y_START;
        if ($type === 'parent') {
            $y--;
            $instance->grid->cellPlot($x, $y, self::newPlot('bottom-left'));
            $x--;
            $instance->grid->cellPlot($x, $y, self::newPlot('top-right'));
            $y--;
            $instance->grid->cellPlot($x, $y, self::newPlot(($i===0) ? 'bottom-left' : 'right-bottom-left'));
            if ($i===0) {
                $x--;
            } else {
                $x++;
            }
        } elseif ($type === 'sibling') {
            $y--;
            $instance->grid->cellPlot($x, $y, self::newPlot('bottom-left'));
            $x--;
            $instance->grid->cellPlot($x, $y, self::newPlot('top-right-left'));
            for ($j = $i+1; $j > 0; $j--) {
                if ($j === 1) {
                    $x--;
                    $instance->grid->cellPlot($x, $y, self::newPlot('right-bottom'));
                } else {
                    $x--;
                    $instance->grid->cellPlot($x, $y, self::newPlot('right-bottom-left'));
                    $x--;
                    $instance->grid->cellPlot($x, $y, self::newPlot('right-left'));
                }
            }
            $y++;
        } elseif ($type === 'partner') {
            $x++;
            $instance->grid->cellPlot($x, $y, self::newPlot('right-bottom-left'));
            $x++;
        } elseif ($type === 'child') {
            $x++;
            $instance->grid->cellPlot($x, $y, self::newPlot('right-bottom-left'));
            $y++;
            if ($i === 0) {
                $instance->grid->cellPlot($x, $y, self::newPlot('top-right'));
                $x++;
                $instance->grid->cellPlot($x, $y, self::newPlot('bottom-left'));
                $y++;
            } else {
                $instance->grid->cellPlot($x, $y, self::newPlot('top-right-left'));
                $x--;
                for ($j = $i; $j > 0; $j--) {
                    if ($j === 1) {
                        $instance->grid->cellPlot($x, $y, self::newPlot('right-bottom'));
                        $y++;
                    } else {
                        $instance->grid->cellPlot($x, $y, self::newPlot('right-bottom-left'));
                        $x--;
                        $instance->grid->cellPlot($x, $y, self::newPlot('right-left'));
                        $x--;
                    }
                }
            }
        }
        $instance->grid->cellRecord($x, $y, self::newRecord($record));
    }

    static public function newPlot($cssClass)
    {
        $plot = new GridCellPlot;
        $plot->cssClass = $cssClass;
        return $plot;
    }

    static public function newRecord($data)
    {
        $record = new GridCellRecord;
        $record->name = $data['name'];
        $record->rel_type = $data['rel_type'];
        $record->record = $data['record'];
        return $record;
    }
}