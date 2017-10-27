<?php
namespace common\tests\DesignPatterns\Structural;


use common\components\DesignPatterns\Structural\Facade\BiosInterface;
use common\components\DesignPatterns\Structural\Facade\Facade;
use common\components\DesignPatterns\Structural\Facade\OsInterface;

class FacadeTest extends \Codeception\Test\Unit
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

    public function testComputerOn()
    {
        /** @var OsInterface|\PHPUnit_Framework_MockObject_MockObject $os */
        $os = $this->getMockBuilder(OsInterface::class)
            ->setMethods(['halt', 'getName'])
            ->disableAutoload()
            ->getMock();

        $os->method('getName')
            ->will($this->returnValue('Linux'));

        /** @var BiosInterface|\PHPUnit_Framework_MockObject_MockObject $bios */
        $bios = $this->getMockBuilder(BiosInterface::class)
            ->setMethods(['launch', 'execute', 'waitForKeyPress'])
            ->disableAutoload()
            ->getMock();

        $bios->expects($this->once())
            ->method('launch')
            ->with($os);

        $facade = new Facade($bios, $os);

        // the facade interface is simple
        $facade->turnOn();

        // but you can also access the underlying components
        $this->assertEquals('Linux', $os->getName());
    }
}