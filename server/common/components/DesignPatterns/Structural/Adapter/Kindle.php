<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 20:07
 */

namespace common\components\DesignPatterns\Structural\Adapter;


class Kindle implements EBookInterface
{
    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var int
     */
    private $totalPages = 100;

    public function unlock()
    {
    }

    public function pressNext()
    {
        $this->page++;
    }

    public function getPage(): array
    {
        return [$this->page, $this->totalPages];
    }
}