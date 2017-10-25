<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 22:03
 */

namespace common\components\DesignPatterns\Structural\Proxy;


class Record
{
    /**
     * @var string[]
     */
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function __set(string $name, string $value)
    {
        $this->data[$name] = $value;
    }

    public function __get(string $name): string
    {
        if (!isset($this->data[$name])) {
            throw new OutOfRangeException('Invalid name given');
        }

        return $this->data[$name];
    }
}