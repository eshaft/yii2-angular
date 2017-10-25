<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 21:45
 */

namespace common\components\DesignPatterns\Structural\Flyweight;


class CharacterFlyweight implements FlyweightInterface
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function render(string $font): string
    {
        return sprintf('Character %s with font %s', $this->name, $font);
    }
}