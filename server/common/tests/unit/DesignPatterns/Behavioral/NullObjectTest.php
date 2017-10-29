<?php
namespace common\tests\DesignPatterns\Behavioral;


use common\components\DesignPatterns\Behavioral\NullObject\NullLogger;
use common\components\DesignPatterns\Behavioral\NullObject\PrintLogger;
use common\components\DesignPatterns\Behavioral\NullObject\Service;

class NullObjectTest extends \Codeception\Test\Unit
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

    public function testNullObject()
    {
        $service = new Service(new NullLogger());
        $this->expectOutputString('');
        $service->doSomething();
    }

    public function testStandardLogger()
    {
        $service = new Service(new PrintLogger());
        $this->expectOutputString('We are in common\components\DesignPatterns\Behavioral\NullObject\Service::doSomething');
        $service->doSomething();
    }
}