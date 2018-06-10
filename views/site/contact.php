<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->/** @scrutinizer ignore-call */hasFlash('contactFormSubmitted')): ?>
        <div class="alert alert-success">
            Danke für Ihre Nachricht, wir werden uns so bald wie möglich um Ihr anliegen kümmern.
        </div>
    <?php else: ?>
        <?php $form = ActiveForm::begin([
            'id' => 'contact-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'options' => [
    //				'tag' => false,
                ],
                'horizontalCssClasses' => [
                    'label' => 'col-md-4',
                    'offset' => 'col-md-offset-2',
                    'wrapper' => 'col-md-6',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]); ?>
        <div class="form-fields container">
            <div class="form-row">
                <div class="form-group col-sm-6">
                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'subject') ?>
                </div>
                <div class="form-group col-sm-6">
                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">                        
                <?= $form->field($model, 'verifyCode')->widget(Captcha::class) ?>
                </div>
            </div>
        </div>
        <div class="form-group">
		<?= Html::submitButton('Absenden!', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
	    </div>
        <?php ActiveForm::end(); ?>
    <?php endif; ?>
</div>
