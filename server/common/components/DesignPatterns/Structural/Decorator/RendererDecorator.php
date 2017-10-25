<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 18:01
 */

namespace common\components\DesignPatterns\Structural\Decorator;


abstract class RendererDecorator implements RenderableInterface
{
    /**
     * @var RenderableInterface
     */
    protected $wrapped;

    public function __construct(RenderableInterface $renderer)
    {
        $this->wrapped = $renderer;
    }
}