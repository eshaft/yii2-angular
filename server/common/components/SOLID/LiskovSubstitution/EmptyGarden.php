<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09.11.17
 * Time: 10:27
 */

namespace common\components\SOLID\LiskovSubstitution;


/**
 * @purpose
 *
 * Provides empty garden space full of dirt which can
 * grow and produce items.
 *
 */
class EmptyGarden
{
    private $plot;

    public function __construct(PlotArea $plot)
    {
        $this->plot = $plot;
    }

    public function items(): array
    {
        $numberOfPlots = $this->plot->totalNumberOfPlots();
        return array_fill(0, $numberOfPlots, 'handful of dirt');
    }
}