<?php
namespace common\tests\DesignPatterns\Structural;


use common\components\DesignPatterns\Structural\Decorator\JsonRenderer;
use common\components\DesignPatterns\Structural\Decorator\WebService;
use common\components\DesignPatterns\Structural\Decorator\XmlRenderer;

class DecoratorTest extends \Codeception\Test\Unit
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

    /**
     * @var Webservice
     */
    private $service;

    protected function setUp()
    {
        $this->service = new Webservice('foobar');
    }

    public function testJsonDecorator()
    {
        $service = new JsonRenderer($this->service);

        $this->assertEquals('"foobar"', $service->renderData());
    }

    public function testXmlDecorator()
    {
        $service = new XmlRenderer($this->service);

        $this->assertXmlStringEqualsXmlString('<?xml version="1.0"?><content>foobar</content>', $service->renderData());
    }
}