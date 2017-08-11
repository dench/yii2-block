<?php

namespace dench\block;

use Yii;

/**
 * Class Module
 *
 * @package dench\block
 */
class Module extends \yii\base\Module
{
    /**
     * @var string the namespace that controller classes are in
     */
    public $controllerNamespace = 'dench\block\controllers';

    public function init()
    {
        parent::init();

        Yii::$app->i18n->translations['block'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@dench/block/messages',
        ];
    }
}