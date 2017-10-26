<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 12:13
 */

namespace common\components\DesignPatterns\Behavioral\Strategy;


class ObjectCollection
{
    /**
     * @var array
     */
    private $elements;

    /**
     * @var ComparatorInterface
     */
    private $comparator;

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    public function setComparator(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;
    }

    public function sort(): array
    {
        if (!$this->comparator) {
            throw new LogicException('Comparator is not set');
        }

        uasort($this->elements, [$this->comparator, 'compare']);

        return $this->elements;
    }
}