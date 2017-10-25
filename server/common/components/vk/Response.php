<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 11:08
 */

namespace common\components\vk;


use yii\base\Object;

class Response extends Object
{
    private $response;

    public function __construct($response, array $config = [])
    {
        parent::__construct($config);

        $this->response = $response;
    }

    public function getCurrentUser()
    {
        return $this->response['users'];
    }

    public function getCabinetes()
    {
        return $this->response['cabinetes'];
    }
}