<?php
namespace common\tests\DesignPatterns\Creational;


use common\components\DesignPatterns\Creational\StaticFactory\FormatNumber;
use common\components\DesignPatterns\Creational\StaticFactory\FormatString;
use common\components\DesignPatterns\Creational\StaticFactory\InvalidArgumentException;
use common\components\DesignPatterns\Creational\StaticFactory\StaticFactory;

class StaticFactoryTest extends \Codeception\Test\Unit
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

    public function testCanCreateNumberFormatter()
    {
        $this->assertInstanceOf(
            FormatNumber::class, StaticFactory::factory('number')
        );
    }

    public function testCanCreateStringFormatter()
    {
        $this->assertInstanceOf(
            FormatString::class, StaticFactory::factory('string')
        );
    }

    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);
        StaticFactory::factory('object');
    }
}