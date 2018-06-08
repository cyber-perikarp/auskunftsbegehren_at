<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\AdressdatenSuggest */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\captcha\Captcha;

$this->title = 'Datensammler melden';
?>
<?php if (Yii::$app->session->/** @scrutinizer ignore-call */hasFlash('contactFormSubmitted')): ?>
<div class="alert alert-success">
    Successfully Inserted Data
</div>
<?php elseif (Yii::$app->session->hasFlash('contactFormFailed') || Yii::$app->session->hasFlash('contactFormInvalid')): ?>
<div class="alert alert-<?php echo Yii::$app->session->hasFlash('contactFormInvalid') ? "warning" : "danger"; ?>">
    <?php echo Yii::$app->session->hasFlash('contactFormInvalid') ? "Invalid Data supplyed." : "Failed to Insert data."; ?>
</div>
<?php if (YII_DEBUG): ?>
<p>
    <?php
        highlight_string("<?php\n\$model =\n" . var_export($model, true) . ";\n?>");
        highlight_string("<?php\n\$model->errors =\n" . var_export($model->errors, true) . ";\n?>");
        highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>");
        highlight_string("<?php\n\$_SESSION =\n" . var_export($_SESSION, true) . ";\n?>");
    ?>
</p>
<?php endif; ?>
<?php endif; ?>
<div class="sammler-melden">
    <?php
    $form = ActiveForm::begin([
        'id' => 'suggest-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'layout' => 'horizontal',
        'fieldConfig' => [
            'options' => [
//				'tag' => false,
            ],
            'horizontalCssClasses' => [
                'label' => 'col-md-4',
                'offset' => 'col-md-offset-4',
                'wrapper' => 'col-md-6',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]);
    ?>
	<div class="form-fields container">
        <div class="form-row">
            <div class="form-group col-md-6">
                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            </div>
            <div class="form-group col-md-6">
                <?= $form->field($model, 'branche')->dropDownList(ArrayHelper::map($branchen, 'id', 'name')) ?>
            </div>
        </div>

        <span id="help-data" class="help-block">
            Bitte vollständige Addresse angeben
        </span>

        <div class="form-row">
            <div class="form-group col-md-6">
                <?= $form->field($model, 'adresse') ?>
            </div>
            <div class="form-group col-md-6">
                <?= $form->field($model, 'typ')->dropDownList(ArrayHelper::map($typen, 'id', 'name')) ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <?= $form->field($model, 'plz') ?>
            </div>
            <div class="form-group col-md-6">
                <?= $form->field($model, 'stadt') ?>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <?= $form->field($model, 'bundesland') ?>
            </div>
            <div class="form-group col-md-6">
                <?= $form->field($model, 'land') ?>
            </div>
        </div>

        <span id="help-data" class="help-block">
            Mail oder fax, aber ned beides. (Format: +43664XXXXXXX)</br>
            Ne, beides is auch ok.</br>
            Validierung sagt nein :O</br>
            fucking Captcha (╯°□°）╯︵ ┻━┻
        </span>

        <div class="form-row">
            <div class="form-group col-md-4">
                <?= $form->field($model, 'tel') ?>
            </div>
            <div class="form-group col-md-4">
                <?= $form->field($model, 'email') ?>
            </div>
            <div class="form-group col-md-4">
                <?= $form->field($model, 'fax') ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <?= $form->field($model, 'verifyCode')->widget(Captcha::class, ['captchaAction'=>'auskunft/captcha']) ?>
            </div>
        </div>
    </div>



	<div class="form-group">
		<?= Html::submitButton('Eintragen!', ['class' => 'btn btn-primary']) ?>
	</div>
<?php ActiveForm::end(); ?>

</div><!-- sammler-melden -->
