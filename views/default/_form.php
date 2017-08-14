<?php

use dench\language\models\Language;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model dench\block\models\Block */
/* @var $form yii\widgets\ActiveForm */

$js = "CKEDITOR.config.autoParagraph = false;";

$this->registerJs($js);
?>
<div class="block-form">

    <?php $form = ActiveForm::begin(); ?>

    <ul class="nav nav-tabs">
        <li class="nav-item active"><a href="#tab-main" class="nav-link" data-toggle="tab"><?= Yii::t('block', 'Main') ?></a></li>
        <?php foreach (Language::suffixList() as $suffix => $name) : ?>
            <li class="nav-item"><a href="#lang<?= $suffix ?>" class="nav-link" data-toggle="tab"><?= $name ?></a></li>
        <?php endforeach; ?>
    </ul>

    <div class="tab-content">

        <div class="tab-pane active" id="tab-main">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'controller')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'enabled')->checkbox() ?>
        </div>

        <?php foreach (Language::suffixList() as $suffix => $name) : ?>
            <div class="tab-pane fade" id="lang<?= $suffix ?>">
                <?= $form->field($model, 'html' . $suffix)->widget(CKEditor::className(), [
                    'preset' => 'full',
                    'options' => [
                        'id' => 'pagetext' . $suffix,
                    ],
                    'clientOptions' => [
                        'customConfig' => '/js/ckeditor.js',
                        'language' => Yii::$app->language,
                        'allowedContent' => true,
                    ]
                ]) ?>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('block', 'Create') : Yii::t('block', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
