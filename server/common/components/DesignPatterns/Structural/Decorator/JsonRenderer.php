<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 18:06
 */

namespace common\components\DesignPatterns\Structural\Decorator;


class JsonRenderer extends RendererDecorator
{
    public function renderData(): string
    {
        return json_encode($this->wrapped->renderData());
    }
}