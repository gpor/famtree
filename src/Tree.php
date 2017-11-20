<?php

namespace Gpor\Famtree;


class Tree extends GporBase
{
    public $relations = [];
    public $parents = [];
    public $siblings = [];
    public $partner;
    public $children = [];

    public function defaultTemplate()
    {
        return 'tree';
    }

    public $datasource;
}