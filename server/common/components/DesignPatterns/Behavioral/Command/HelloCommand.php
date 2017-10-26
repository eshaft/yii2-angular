<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 14:43
 */

namespace common\components\DesignPatterns\Behavioral\Command;


class HelloCommand implements CommandInterface
{
    /**
     * @var Receiver
     */
    private $output;

    public function __construct(Receiver $console)
    {
        $this->output = $console;
    }

    public function execute()
    {
        $this->output->write('Hello World');
    }
}