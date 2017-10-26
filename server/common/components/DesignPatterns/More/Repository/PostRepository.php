<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 20:42
 */

namespace common\components\DesignPatterns\More\Repository;


class PostRepository
{
    /**
     * @var MemoryStorage
     */
    private $persistence;

    public function __construct(MemoryStorage $persistence)
    {
        $this->persistence = $persistence;
    }

    public function findById(int $id): Post
    {
        $arrayData = $this->persistence->retrieve($id);

        if (is_null($arrayData)) {
            throw new \InvalidArgumentException(sprintf('Post with ID %d does not exist', $id));
        }

        return Post::fromState($arrayData);
    }

    public function save(Post $post)
    {
        $id = $this->persistence->persist([
            'text' => $post->getText(),
            'title' => $post->getTitle(),
        ]);

        $post->setId($id);
    }
}