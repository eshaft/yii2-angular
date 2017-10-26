<?php
namespace common\tests\DesignPatterns\Creational;


use common\components\DesignPatterns\Creational\AbstractFactory\HtmlFactory;
use common\components\DesignPatterns\Creational\AbstractFactory\HtmlText;
use common\components\DesignPatterns\Creational\AbstractFactory\JsonFactory;
use common\components\DesignPatterns\Creational\AbstractFactory\JsonText;

class AbstractFactoryTest extends \Codeception\Test\Unit
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

    public function testCanCreateHtmlText()
    {
        $factory = new HtmlFactory();
        $text = $factory->createText('foobar');

        $this->assertInstanceOf(HtmlText::class, $text);
    }

    public function testCanCreateJsonText()
    {
        $factory = new JsonFactory();
        $text = $factory->createText('foobar');

        $this->assertInstanceOf(JsonText::class, $text);
    }
}