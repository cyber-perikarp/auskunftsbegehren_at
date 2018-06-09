<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdressdatenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adressdaten-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'branche') ?>

    <?= $form->field($model, 'typ') ?>

    <?= $form->field($model, 'adresse') ?>

    <?php // echo $form->field($model, 'plz') ?>

    <?php // echo $form->field($model, 'stadt') ?>

    <?php // echo $form->field($model, 'bundesland') ?>

    <?php // echo $form->field($model, 'land') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
