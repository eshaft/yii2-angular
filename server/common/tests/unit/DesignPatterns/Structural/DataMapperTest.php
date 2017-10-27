<?php
namespace common\tests\DesignPatterns\Structural;


use common\components\DesignPatterns\Structural\DataMapper\InvalidArgumentException;
use common\components\DesignPatterns\Structural\DataMapper\StorageAdapter;
use common\components\DesignPatterns\Structural\DataMapper\User;
use common\components\DesignPatterns\Structural\DataMapper\UserMapper;

class DataMapperTest extends \Codeception\Test\Unit
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

    public function testCanMapUserFromStorage()
    {
        $storage = new StorageAdapter([1 => ['username' => 'domnikl', 'email' => 'liebler.dominik@gmail.com']]);
        $mapper = new UserMapper($storage);

        $user = $mapper->findById(1);

        $this->assertInstanceOf(User::class, $user);
    }

    public function testWillNotMapInvalidData()
    {
        $this->expectException(InvalidArgumentException::class);
        $storage = new StorageAdapter([]);
        $mapper = new UserMapper($storage);

        $mapper->findById(1);
    }
}