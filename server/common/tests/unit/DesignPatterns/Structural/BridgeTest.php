<?php
namespace common\tests\DesignPatterns\Structural;


use common\components\DesignPatterns\Structural\Bridge\HelloWorldService;
use common\components\DesignPatterns\Structural\Bridge\HtmlFormatter;
use common\components\DesignPatterns\Structural\Bridge\PlainTextFormatter;

class BridgeTest extends \Codeception\Test\Unit
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

    public function testCanPrintUsingThePlainTextPrinter()
    {
        $service = new HelloWorldService(new PlainTextFormatter());
        $this->assertEquals('Hello World!', $service->get());

        // now change the implementation and use the HtmlFormatter instead
        $service->setImplementation(new HtmlFormatter());
        $this->assertEquals('<p>Hello World!</p>', $service->get());
    }
}