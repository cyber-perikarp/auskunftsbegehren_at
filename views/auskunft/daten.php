<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Auskunft */
/* @var $form ActiveForm */

$this->title = "Generieren";
?>
<div class="auskunft-daten">
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'firstName') ?>
        <?= $form->field($model, 'lastName') ?>
        <?= $form->field($model, 'street') ?>
        <?= $form->field($model, 'streetNumber') ?>
        <?= $form->field($model, 'zip') ?>
        <?= $form->field($model, 'city') ?>
        <?= $form->field($model, 'idType')->dropDownList(ArrayHelper::map($idTypes, 'id', 'name')); ?>
        <?= $form->field($model, 'additional') ?>

        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'reminder')->checkbox() ?>

        <?= $form->field($model, 'targets')->checkboxList(ArrayHelper::map($adressdaten, 'id', 'name')); ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- auskunft-daten -->
