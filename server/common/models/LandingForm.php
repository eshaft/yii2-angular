<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 10.11.17
 * Time: 17:14
 */

namespace common\models;


use Yii;
use yii\base\Model;

/**
 * Class LandingForm
 * @package common\models
 */
class LandingForm extends Model
{
    public $name;
    public $phone;

    public function rules()
    {
        return [
            [['name', 'phone'], 'trim'],
            [['name', 'phone'], 'required'],
            [['name', 'phone'], 'string', 'max' => 255],
            ['phone', 'match', 'pattern' => $this->getPhonePattern()]
        ];
    }

    private function getPhonePattern()
    {
        return '/^\+7\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}$/';
    }

    public function getPhoneMask()
    {
        return '+7(999)999-99-99';
    }

    public function sendEmail()
    {
        $body = $this->name . ' - ' . $this->phone;

        return Yii::$app
            ->mailer
            ->compose(
                ['text' => 'queue-text'], ['body' => $body]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo(Yii::$app->params['supportEmail'])
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }
}