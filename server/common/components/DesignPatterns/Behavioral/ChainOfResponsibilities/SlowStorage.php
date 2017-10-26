<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 11:07
 */

namespace common\components\DesignPatterns\Behavioral\ChainOfResponsibilities;


class SlowStorage extends Handler
{
    protected function processing(\Psr\Http\Message\RequestInterface $request)
    {
        return 'Chain works!';
    }
}