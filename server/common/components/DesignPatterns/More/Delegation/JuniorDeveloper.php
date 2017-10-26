<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 21:28
 */

namespace common\components\DesignPatterns\More\Delegation;


class JuniorDeveloper
{
    public function writeBadCode(): string
    {
        return 'Some junior developer generated code...';
    }
}