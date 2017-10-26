<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 19:22
 */

namespace common\components\DesignPatterns\More\Repository;


class MemoryStorage
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var int
     */
    private $lastId = 0;

    public function persist(array $data): int
    {
        $this->lastId++;

        $data['id'] = $this->lastId;
        $this->data[$this->lastId] = $data;

        return $this->lastId;
    }

    public function retrieve(int $id): array
    {
        if (!isset($this->data[$id])) {
            throw new OutOfRangeException(sprintf('No data found for ID %d', $id));
        }

        return $this->data[$id];
    }

    public function delete(int $id)
    {
        if (!isset($this->data[$id])) {
            throw new OutOfRangeException(sprintf('No data found for ID %d', $id));
        }

        unset($this->data[$id]);
    }
}