<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 16:51
 */

namespace common\components\DesignPatterns\Behavioral\Specifications;


interface SpecificationInterface
{
    public function isSatisfiedBy(Item $item): bool;
}