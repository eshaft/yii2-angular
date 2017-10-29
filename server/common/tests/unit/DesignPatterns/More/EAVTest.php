<?php
namespace common\tests\DesignPatterns\More;


use common\components\DesignPatterns\More\EAV\Attribute;
use common\components\DesignPatterns\More\EAV\Entity;
use common\components\DesignPatterns\More\EAV\Value;

class EAVTest extends \Codeception\Test\Unit
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

    public function testCanAddAttributeToEntity()
    {
        $colorAttribute = new Attribute('color');
        $colorSilver = new Value($colorAttribute, 'silver');
        $colorBlack = new Value($colorAttribute, 'black');
        $memoryAttribute = new Attribute('memory');
        $memory8Gb = new Value($memoryAttribute, '8GB');
        $entity = new Entity('MacBook Pro', [$colorSilver, $colorBlack, $memory8Gb]);
        $this->assertEquals('MacBook Pro, color: silver, color: black, memory: 8GB', (string) $entity);
    }
}