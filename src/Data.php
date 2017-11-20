<?php

namespace Gpor\Famtree;


class Data extends GporBase
{
    /**
     * @var Grid
     */
    public $grid;

    public $clientData;

    public $parents = [];
    public $siblings = [];
    public $partner;
    public $children = [];

    public function defaultTemplate()
    {
        return 'data';
    }

}