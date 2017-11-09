<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09.11.17
 * Time: 10:15
 */

namespace common\components\SOLID\OpenClosed;


use common\components\SOLID\SingleResponsibility\EmptyGarden;

class StrawberryGarden extends EmptyGarden
{
    public function items()
    {
        return array_fill(0, $this->width * $this->height, 'weed');
    }
}