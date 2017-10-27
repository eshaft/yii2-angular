<?php
namespace common\tests\DesignPatterns\Structural;


use common\components\DesignPatterns\Structural\Registry\InvalidArgumentException;
use common\components\DesignPatterns\Structural\Registry\Registry;
use stdClass;

class RegistryTest extends \Codeception\Test\Unit
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

    public function testSetAndGetLogger()
    {
        $key = Registry::LOGGER;
        $logger = new stdClass();

        Registry::set($key, $logger);
        $storedLogger = Registry::get($key);

        $this->assertSame($logger, $storedLogger);
        $this->assertInstanceOf(stdClass::class, $storedLogger);
    }

    public function testThrowsExceptionWhenTryingToSetInvalidKey()
    {
        $this->expectException(InvalidArgumentException::class);
        Registry::set('foobar', new stdClass());
    }

    public function testThrowsExceptionWhenTryingToGetNotSetKey()
    {
        $this->expectException(InvalidArgumentException::class);
        Registry::get('777');
    }
}