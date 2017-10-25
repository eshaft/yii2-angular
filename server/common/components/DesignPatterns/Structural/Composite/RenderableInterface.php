<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 17:33
 */

namespace common\components\DesignPatterns\Structural\Composite;


interface RenderableInterface
{
    public function render(): string;
}