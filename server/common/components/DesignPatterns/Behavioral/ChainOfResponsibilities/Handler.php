<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 10:43
 */

namespace common\components\DesignPatterns\Behavioral\ChainOfResponsibilities;


abstract class Handler
{
    /**
     * @var Handler|null
     */
    private $successor = null;

    public function __construct(Handler $handler = null)
    {
        $this->successor = $handler;
    }

    final public function handle(\Psr\Http\Message\RequestInterface $request)
    {
        $processed = $this->processing($request);

        if($processed === null) {
            if($this->successor !== null) {
                $processed = $this->successor->handle($request);
            }
        }

        return $processed;
    }

    abstract protected function processing(\Psr\Http\Message\RequestInterface $request);
}