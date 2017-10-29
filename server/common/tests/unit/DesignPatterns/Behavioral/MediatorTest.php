<?php
namespace common\tests\DesignPatterns\Behavioral;


use common\components\DesignPatterns\Behavioral\Mediator\Mediator;
use common\components\DesignPatterns\Behavioral\Mediator\Subsystem\Client;
use common\components\DesignPatterns\Behavioral\Mediator\Subsystem\Database;
use common\components\DesignPatterns\Behavioral\Mediator\Subsystem\Server;

class MediatorTest extends \Codeception\Test\Unit
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

    public function testOutputHelloWorld()
    {
        $client = new Client();
        new Mediator(new Database(), $client, new Server());

        $this->expectOutputString('Hello World');
        $client->request();
    }
}