<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 21:47
 */

namespace common\components\DesignPatterns\Structural\Flyweight;


class FlyweightFactory implements \Countable
{
    /**
     * @var CharacterFlyweight[]
     */
    private $pool = [];

    public function count(): int
    {
        return count($this->pool);
    }

    public function get(string $name): CharacterFlyweight
    {
        if (!isset($this->pool[$name])) {
            $this->pool[$name] = new CharacterFlyweight($name);
        }

        return $this->pool[$name];
    }
}