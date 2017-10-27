<?php
namespace common\tests\DesignPatterns\Structural;


use common\components\DesignPatterns\Structural\DependencyInjection\DatabaseConfiguration;
use common\components\DesignPatterns\Structural\DependencyInjection\DatabaseConnection;

class DependencyInjectionTest extends \Codeception\Test\Unit
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

    public function testDependencyInjection()
    {
        $config = new DatabaseConfiguration('localhost', 3306, 'domnikl', '1234');
        $connection = new DatabaseConnection($config);

        $this->assertEquals('domnikl:1234@localhost:3306', $connection->getDsn());
    }
}