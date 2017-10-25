<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 17:58
 */

namespace common\components\DesignPatterns\Structural\Decorator;


interface RenderableInterface
{
    public function renderData(): string;
}