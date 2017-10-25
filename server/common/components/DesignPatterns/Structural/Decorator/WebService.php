<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 17:59
 */

namespace common\components\DesignPatterns\Structural\Decorator;


class WebService implements RenderableInterface
{
    /**
     * @var string
     */
    private $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function renderData(): string
    {
        return $this->data;
    }
}