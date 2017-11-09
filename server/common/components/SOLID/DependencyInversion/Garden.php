<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09.11.17
 * Time: 10:56
 */

namespace common\components\SOLID\DependencyInversion;


use common\components\SOLID\LiskovSubstitution\PlotArea;

class Garden
{
    private $plot;

    public function __construct(PlotArea $plot)
    {
        $this->plot = $plot;
    }
}