<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 15:46
 */

namespace common\components\DesignPatterns\Behavioral\Memento;


class Memento
{
    /**
     * @var State
     */
    private $state;

    public function __construct(State $stateToSave)
    {
        $this->state = $stateToSave;
    }

    public function getState(): State
    {
        return $this->state;
    }
}