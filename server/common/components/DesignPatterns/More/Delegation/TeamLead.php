<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 21:28
 */

namespace common\components\DesignPatterns\More\Delegation;


class TeamLead
{
    /**
     * @var JuniorDeveloper
     */
    private $junior;

    /**
     * @param JuniorDeveloper $junior
     */
    public function __construct(JuniorDeveloper $junior)
    {
        $this->junior = $junior;
    }

    public function writeCode(): string
    {
        return $this->junior->writeBadCode();
    }
}