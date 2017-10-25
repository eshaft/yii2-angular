<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 16:36
 */

namespace common\components\DesignPatterns\Structural\DataMapper;


class User
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    public function __construct(string $username, string $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    public static function fromState(array $state): User
    {
        return new self(
            $state['username'],
            $state['email']
        );
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}