<?php
namespace common\tests\DesignPatterns\More;


use common\components\DesignPatterns\More\Repository\MemoryStorage;
use common\components\DesignPatterns\More\Repository\Post;
use common\components\DesignPatterns\More\Repository\PostRepository;

class RepositoryTest extends \Codeception\Test\Unit
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

    public function testCanPersistAndFindPost()
    {
        $repository = new PostRepository(new MemoryStorage());
        $post = new Post(null, 'Repository Pattern', 'Design Patterns PHP');

        $repository->save($post);

        $this->assertEquals(1, $post->getId());
        $this->assertEquals($post->getId(), $repository->findById(1)->getId());
    }
}