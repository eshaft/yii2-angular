<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 18:03
 */

namespace common\components\DesignPatterns\Structural\Decorator;


class XmlRenderer extends RendererDecorator
{
    public function renderData(): string
    {
        $doc = new \DOMDocument();
        $data = $this->wrapped->renderData();
        $doc->appendChild($doc->createElement('content', $data));

        return $doc->saveXML();
    }
}