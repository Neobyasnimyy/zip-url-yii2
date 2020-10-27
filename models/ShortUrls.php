<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "short_urls".
 *
 * @property int $id
 * @property string $long_url
 * @property string $short_code
 * @property string $time_create
 * @property int $counter
 */
class ShortUrls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'short_urls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['long_url', 'short_code', 'time_create'], 'required'],
            [['long_url'], 'string'],
            [['time_create'], 'safe'],
            [['counter'], 'integer'],
            [['short_code'], 'string', 'max' => 8],
            [['short_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'long_url' => 'Long Url',
            'short_code' => 'Short Code',
            'time_create' => 'Time Create',
            'counter' => 'Counter',
        ];
    }
}
