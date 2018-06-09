<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Adressdaten */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adressdaten-form">

    <?php $form = ActiveForm::begin(['id' => 'admin-create']); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branche')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'typ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adresse')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plz')->textInput() ?>

    <?= $form->field($model, 'stadt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bundesland')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'land')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
