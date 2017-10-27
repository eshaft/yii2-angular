<?php
namespace common\tests\DesignPatterns\Creational;


use common\components\DesignPatterns\Creational\SimpleFactory\Bicycle;
use common\components\DesignPatterns\Creational\SimpleFactory\SimpleFactory;

class SimpleFactoryTest extends \Codeception\Test\Unit
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

    public function testCanCreateBicycle()
    {
        $bicycle = (new SimpleFactory())->createBicycle();
        $this->assertInstanceOf(Bicycle::class, $bicycle);
    }
}