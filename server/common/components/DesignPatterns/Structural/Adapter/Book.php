<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 20:05
 */

namespace common\components\DesignPatterns\Structural\Adapter;


class Book implements BookInterface
{
    /**
     * @var int
     */
    private $page;

    public function turnPage()
    {
        $this->page++;
    }

    public function open()
    {
        $this->page = 1;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}