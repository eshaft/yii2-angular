<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 19:20
 */

namespace common\components\DesignPatterns\More\Repository;


class Post
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $text;

    public function __construct(?int $id = null, string $title, string $text)
    {
        $this->id = $id;
        $this->text = $text;
        $this->title = $title;
    }

    public static function fromState(array $state): Post
    {
        return new self(
            $state['id'],
            $state['title'],
            $state['text']
        );
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}