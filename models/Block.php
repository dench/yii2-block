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
 * @property string $name
 * @property string $controller
 * @property integer $enabled
 *
 * Language
 * @property string $html
 */
class Block extends ActiveRecord
{
    const DISABLED = 0;
    const ENABLED = 1;

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
            [['name'], 'required'],
            [['name'], 'unique'],
            [['name'], 'string', 'max' => 32],
            [['enabled'], 'boolean'],
            [['enabled'], 'default', 'value' => self::ENABLED],
            [['enabled'], 'in', 'range' => [self::ENABLED, self::DISABLED]],
            [['controller'], 'string', 'max' => 255],
            [['html'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('block', 'ID'),
            'name' => Yii::t('block', 'Name'),
            'controller' => Yii::t('block', 'Controller'),
            'enabled' => Yii::t('block', 'Enabled'),
            'html' => Yii::t('block', 'Html'),
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
