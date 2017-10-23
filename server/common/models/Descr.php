<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "descr".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $ads_id
 * @property string $descr
 */
class Descr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'descr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ads_id'], 'required'],
            [['user_id'], 'integer'],
            [['ads_id'], 'string', 'max' => 255],
            [['descr'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'ads_id' => 'Ads ID',
            'descr' => 'Descr',
        ];
    }
}
