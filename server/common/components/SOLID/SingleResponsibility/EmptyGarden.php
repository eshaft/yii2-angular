<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09.11.17
 * Time: 10:06
 */

namespace common\components\SOLID\SingleResponsibility;


/**
 * @purpose
 *
 * Provides empty garden space full of dirt which can
 * grow and produce items.
 *
 */
class EmptyGarden
{
    protected $width;
    protected $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function items()
    {
        $numberOfSpots = ceil($this->width * $this->height);
        return array_fill(0, $numberOfSpots, 'handful of dirt');
    }
}