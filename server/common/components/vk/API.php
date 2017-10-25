<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 10:10
 */
namespace common\components\vk;

use yii\base\Object;
use yii\httpclient\Client;
use yii\httpclient\Exception;

class API extends Object
{
    private $code = [];
    private $access_token;
    public $response;

    public function __construct($access_token, array $config = [])
    {
        parent::__construct($config);

        $this->access_token = $access_token;
    }

    public function getAccounts()
    {
        $this->code[] = '"cabinetes": API.ads.getAccounts()';
        return $this;
    }

    public function getCurrentUser()
    {
        $this->code[] = '"users": API.users.get({"fields": "photo_max"})[0]';
        return $this;
    }

    public function execute()
    {
        $code = implode(',', $this->code);
        $client = new Client();

        try {
            $this->response = $client->createRequest()
                ->setMethod('get')
                ->setUrl('https://api.vk.com/method/execute')
                ->setData([
                    'access_token' => $this->access_token,
                    'code' => '
                        return {
                            '.$code.'
                        };
                    '
                ])
                ->send();
        } catch (Exception $e) {
            throw new VkApiException();
        }

        return $this;
    }

    public function response()
    {
        if ($this->response->isOk) {
            //var_dump($response); exit;
            if(!isset($this->response->data['response'])) {
                throw new VkApiException();
            }
            $this->response = new Response($this->response->data['response']);
            return $this->response;
        } else {
            throw new VkApiException();
        }
    }
}