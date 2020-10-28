<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "short_urls".
 *
 * @property int $id
 * @property string $long_url
 * @property string $short_code
 * @property string $time_create
 * @property int $counter
 *
 */
class ShortUrls extends ActiveRecord
{
    /**
     * symbols to generate url
     */
    public const SIMBOLS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';


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
            ['long_url', 'required', 'message' => 'Ссылка не должна быть пустой!'],
            ['long_url', 'string'],
            ['long_url', 'trim'],
            ['long_url', 'url', 'message' => 'Не корректная ссылка!'],
            ['long_url', 'match', 'pattern' => '/^\S*$/', 'message' => 'Удалите пробелы!'],
            ['long_url', 'unique', 'message' => 'Эта ссылка уже была сгенерированна!'],
            [['time_create'], 'safe'],
            [['counter'], 'integer'],
            [['short_code'], 'string', 'max' => 8],

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


    /**
     *  domain + short_code
     *
     * @return string
     */
    public function getShortUrl()
    {
        return Yii::$app->request->hostInfo . '/' . $this->short_code;
    }

    /**
     * генерируем строку и проверяем ее на уникальность
     *
     * @return string
     */
    public function genShortCode()
    {
        do {
            $shortCode = substr(str_shuffle(self::SIMBOLS), 0, 8);
        } while (self::find()->where(['short_code' => $shortCode])->one());

        return $shortCode;
    }

    /**
     * @param $code
     *
     * @return null|ActiveRecord
     * @throws NotFoundHttpException
     */
    public static function validateShortCode($code)
    {
        if (!preg_match('|^[0-9a-zA-Z]{8,8}$|', $code)) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }

        $model_url = self::find()->where(['short_code' => $code])->one();

        if ($model_url === null) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }

        return $model_url;
    }

}
