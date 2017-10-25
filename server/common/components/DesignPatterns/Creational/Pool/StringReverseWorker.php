<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 14:48
 */

namespace common\components\DesignPatterns\Creational\Pool;


class StringReverseWorker
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function run(string $text)
    {
        return strrev($text);
    }
}