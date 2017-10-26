<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 18:36
 */

namespace common\components\DesignPatterns\Behavioral\Visitor;


interface RoleVisitorInterface
{
    public function visitUser(User $role);

    public function visitGroup(Group $role);
}