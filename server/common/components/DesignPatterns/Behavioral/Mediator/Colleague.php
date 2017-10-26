<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 12:45
 */

namespace common\components\DesignPatterns\Behavioral\Mediator;


abstract class Colleague
{
    /**
     * @var MediatorInterface
     */
    protected $mediator;

    public function setMediator(MediatorInterface $mediator)
    {
        $this->mediator = $mediator;
    }
}