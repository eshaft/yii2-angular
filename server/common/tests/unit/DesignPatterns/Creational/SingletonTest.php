<?php
namespace common\tests\DesignPatterns\Creational;


use common\components\DesignPatterns\Creational\Singleton\Singleton;

class SingletonTest extends \Codeception\Test\Unit
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

    public function testUniqueness()
    {
        $firstCall = Singleton::getInstance();
        $secondCall = Singleton::getInstance();

        $this->assertInstanceOf(Singleton::class, $firstCall);
        $this->assertInstanceOf(Singleton::class, $secondCall);
        $this->assertSame($firstCall, $secondCall);
    }
}