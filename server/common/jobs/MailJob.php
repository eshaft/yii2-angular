<?php

namespace common\jobs;
use Yii;

/**
 * Class MailJob.
 */
class MailJob extends \yii\base\Object implements \yii\queue\Job
{
    public $name;

    public $email;

    public $title;

    public $body;

    /**
     * @inheritdoc
     */
    public function execute($queue)
    {
        Yii::$app
            ->mailer
            ->compose(['text' => 'queue-text'], ['body' => $this->body])
            ->setFrom(['eshaft@gmail.com' => 'eshaft'])
            ->setTo($this->email)
            ->setSubject($this->title)
            ->send();
    }
}