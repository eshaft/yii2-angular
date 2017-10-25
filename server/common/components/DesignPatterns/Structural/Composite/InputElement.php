<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 17:42
 */

namespace common\components\DesignPatterns\Structural\Composite;


class InputElement implements RenderableInterface
{
    public function render(): string
    {
        return '<input type="text" />';
    }
}