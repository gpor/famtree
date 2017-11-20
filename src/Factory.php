<?php

namespace Gpor\Famtree;
dd('found');

class Factory
{
    static public function instance($data)
    {
        $tree = new Tree();
        $tree->datasource = $data;
        return $tree;
    }
}