<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 16:41
 */

namespace common\components\DesignPatterns\Structural\DataMapper;


class StorageAdapter
{
    /**
     * @var array
     */
    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param int $id
     *
     * @return array|null
     */
    public function find(int $id): ?array
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }

        return null;
    }
}