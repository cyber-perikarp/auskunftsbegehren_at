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
<div class="sammler-melden">
    <?php
	$form = ActiveForm::begin([
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
            <div class="form-group col-md-12">
                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            </div>
        </div>

        <div class="form-row">
			<div class="form-group col-md-12">
				<?= $form->field($model, 'idType')->dropDownList(ArrayHelper::map($idTypes, 'id', 'name')); ?>
			</div>
		</div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <?= $form->field($model, 'branche')->dropDownList(ArrayHelper::map($branchen, 'id', 'name')); ?>
            </div>
            <div class="form-group col-md-6">
                <?= $form->field($model, 'typ')->dropDownList(ArrayHelper::map($typen, 'id', 'name')); ?>
            </div>
        </div>
        <!-- <span id="help-data" class="help-block">
            Bitte korrekte Addresse angeben
        </span> -->
        <div class="form-row">
            <div class="form-group col-md-12">
                <?= $form->field($model, 'adresse') ?>
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

        <!-- <span id="help-data" class="help-block">
            Mail oder fax, aber ned beides.
            Ne, beides is auch ok. (Validierung)
        </span> -->

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
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
            </div>
        </div>
    </div>



	<div class="form-group">
		<?= Html::submitButton('Absenden!', ['class' => 'btn btn-primary']) ?>
	</div>
<?php ActiveForm::end(); ?>

</div><!-- sammler-melden -->