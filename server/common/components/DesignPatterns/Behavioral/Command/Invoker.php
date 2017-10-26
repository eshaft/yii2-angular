<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 14:35
 */

namespace common\components\DesignPatterns\Behavioral\Command;


class Invoker
{
    /**
     * @var CommandInterface
     */
    private $command;

    public function setCommand(CommandInterface $cmd)
    {
        $this->command = $cmd;
    }

    public function run()
    {
        $this->command->execute();
    }
}