<?php
namespace common\tests\DesignPatterns\Structural;


use common\components\DesignPatterns\Structural\Proxy\RecordProxy;

class ProxyTest extends \Codeception\Test\Unit
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

    public function testWillSetDirtyFlagInProxy()
    {
        $recordProxy = new RecordProxy([]);
        $recordProxy->username = 'baz';
        $this->assertTrue($recordProxy->isDirty());
    }
    public function testProxyIsInstanceOfRecord()
    {
        $recordProxy = new RecordProxy([]);
        $recordProxy->username = 'baz';
        $this->assertInstanceOf(RecordProxy::class, $recordProxy);
    }
}