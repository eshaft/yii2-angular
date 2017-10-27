<?php
namespace common\tests\DesignPatterns\Structural;


use common\components\DesignPatterns\Structural\Composite\Form;
use common\components\DesignPatterns\Structural\Composite\InputElement;
use common\components\DesignPatterns\Structural\Composite\TextElement;

class CompositeTest extends \Codeception\Test\Unit
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

    public function testRender()
    {
        $form = new Form();
        $form->addElement(new TextElement('Email:'));
        $form->addElement(new InputElement());
        $embed = new Form();
        $embed->addElement(new TextElement('Password:'));
        $embed->addElement(new InputElement());
        $form->addElement($embed);

        // This is just an example, in a real world scenario it is important to remember that web browsers do not
        // currently support nested forms

        $this->assertEquals(
            '<form>Email:<input type="text" /><form>Password:<input type="text" /></form></form>',
            $form->render()
        );
    }
}