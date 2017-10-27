<?php
namespace common\tests\DesignPatterns\Behavioral;


use common\components\DesignPatterns\Behavioral\Command\HelloCommand;
use common\components\DesignPatterns\Behavioral\Command\Invoker;
use common\components\DesignPatterns\Behavioral\Command\Receiver;

class CommandTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testInvocation()
    {
        $invoker = new Invoker();
        $receiver = new Receiver();

        $invoker->setCommand(new HelloCommand($receiver));
        $invoker->run();
        $this->assertEquals('Hello World', $receiver->getOutput());
    }
}