<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09.11.17
 * Time: 10:23
 */

namespace common\components\SOLID\LiskovSubstitution;


class RectangleArea implements PlotArea
{
    private $width;
    private $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function totalNumberOfPlots()
    {
        return ceil($this->width * $this->height / 2);
    }
}