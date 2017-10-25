<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 17:34
 */

namespace common\components\DesignPatterns\Structural\Composite;


class Form implements RenderableInterface
{
    /**
     * @var RenderableInterface[]
     */
    private $elements = [];

    public function render(): string
    {
        $formCode = '<form>';

        foreach ($this->elements as $element) {
            $formCode .= $element->render();
        }

        $formCode .= '</form>';

        return $formCode;
    }

    public function addElement(RenderableInterface $element)
    {
        $this->elements[] = $element;
    }
}