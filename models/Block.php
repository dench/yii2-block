<?php

namespace dench\block\models;

use dench\language\behaviors\LanguageBehavior;
use omgdef\multilingual\MultilingualQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "block".
 *
 * @property integer $id
 * @property string $code
 * @property string $controller
 * @property integer $enabled
 *
 * Language
 *
 * @property string $name
 * @property string $text
 */
class Block extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            LanguageBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['enabled'], 'integer'],
            [['code'], 'string', 'max' => 32],
            [['controller', 'name'], 'string', 'max' => 255],
            [['text'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('block', 'ID'),
            'code' => Yii::t('block', 'Code'),
            'controller' => Yii::t('block', 'Controller'),
            'enabled' => Yii::t('block', 'Enabled'),
            'name' => Yii::t('block', 'Name'),
            'text' => Yii::t('block', 'Text'),
        ];
    }

    /**
     * @return MultilingualQuery|\yii\db\ActiveQuery
     */
    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }
}
