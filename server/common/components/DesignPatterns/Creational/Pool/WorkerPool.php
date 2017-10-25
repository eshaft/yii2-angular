<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 14:46
 */

namespace common\components\DesignPatterns\Creational\Pool;


class WorkerPool
{
    private $freeWorkers = [];
    private $occupiedWorkers = [];

    public function get(): StringReverseWorker
    {
        if(count($this->freeWorkers) == 0) {
            $worker = new StringReverseWorker();
        } else {
            $worker = array_pop($this->freeWorkers);
        }

        $this->occupiedWorkers[spl_object_hash($worker)] = $worker;

        return $worker;
    }

    public function dispose(StringReverseWorker $worker)
    {
        $key = spl_object_hash($worker);
        if(isset($this->occupiedWorkers[$key])) {
            unset($this->occupiedWorkers[$key]);
            $this->freeWorkers[$key] = $worker;
        }
    }

    public function count(): int
    {
        return count($this->freeWorkers) + count($this->occupiedWorkers);
    }
}