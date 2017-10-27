<?php
namespace common\tests\DesignPatterns\Behavioral;


use common\components\DesignPatterns\Behavioral\ChainOfResponsibilities\FastStorage;
use common\components\DesignPatterns\Behavioral\ChainOfResponsibilities\Handler;
use common\components\DesignPatterns\Behavioral\ChainOfResponsibilities\SlowStorage;

class ChainOfResponsibilitiesTest extends \Codeception\Test\Unit
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
     * @var Handler
     */
    private $chain;

    protected function setUp()
    {
        $this->chain = new FastStorage(
            ['/foo/bar?index=1' => 'Hello In Memory!'],
            new SlowStorage()
        );
    }

    public function testCanRequestKeyInFastStorage()
    {
        $uri = $this->getMockBuilder('Psr\Http\Message\UriInterface')
                    ->getMock();
        $uri->method('getPath')->willReturn('/foo/bar');
        $uri->method('getQuery')->willReturn('index=1');

        $request = $this->getMockBuilder('Psr\Http\Message\RequestInterface')
                        ->getMock();
        $request->method('getMethod')
            ->willReturn('GET');
        $request->method('getUri')->willReturn($uri);

        $this->assertEquals('Hello In Memory!', $this->chain->handle($request));
    }

    public function testCanRequestKeyInSlowStorage()
    {
        $uri = $this->getMockBuilder('Psr\Http\Message\UriInterface')
                    ->getMock();
        $uri->method('getPath')->willReturn('/foo/baz');
        $uri->method('getQuery')->willReturn('');

        $request = $this->getMockBuilder('Psr\Http\Message\RequestInterface')
                        ->getMock();
        $request->method('getMethod')
            ->willReturn('GET');
        $request->method('getUri')->willReturn($uri);

        $this->assertEquals('Chain works!', $this->chain->handle($request));
    }
}