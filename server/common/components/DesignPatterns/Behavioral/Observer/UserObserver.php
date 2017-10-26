<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 16:08
 */

namespace common\components\DesignPatterns\Behavioral\Observer;


class UserObserver implements \SplObserver
{
    /**
     * @var User[]
     */
    private $changedUsers = [];

    public function getChangedUsers(): array
    {
        return $this->changedUsers;
    }

    public function update(\SplSubject $subject)
    {
        $this->changedUsers[] = clone $subject;
    }
}