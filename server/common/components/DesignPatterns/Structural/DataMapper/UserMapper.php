<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 16:47
 */

namespace common\components\DesignPatterns\Structural\DataMapper;


class UserMapper
{
    /**
     * @var StorageAdapter
     */
    private $adapter;

    public function __construct(StorageAdapter $storage)
    {
        $this->adapter = $storage;
    }

    public function findById(int $id): User
    {
        $result = $this->adapter->find($id);

        if($result === null) {
            throw new InvalidArgumentException("User #$id not found");
        }

        return $this->mapRowToUser($result);
    }

    private function mapRowToUser(array $row): User
    {
        return User::fromState($row);
    }
}