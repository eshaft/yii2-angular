<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 20:09
 */

namespace common\components\DesignPatterns\Structural\Adapter;


class EBookAdapter implements BookInterface
{
    /**
     * @var EBookInterface
     */
    protected $eBook;

    public function __construct(EBookInterface $eBook)
    {
        $this->eBook = $eBook;
    }

    public function turnPage()
    {
        $this->eBook->pressNext();
    }

    public function open()
    {
        $this->eBook->unlock();
    }

    public function getPage(): int
    {
        return $this->eBook->getPage()[0];
    }
}