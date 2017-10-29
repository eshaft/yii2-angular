<?php
namespace common\tests\DesignPatterns\More;


use common\components\DesignPatterns\More\Delegation\JuniorDeveloper;
use common\components\DesignPatterns\More\Delegation\TeamLead;

class DelegationTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testHowTeamLeadWriteCode()
    {
        $junior = new JuniorDeveloper();
        $teamLead = new TeamLead($junior);

        $this->assertEquals($junior->writeBadCode(), $teamLead->writeCode());
    }
}