<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Auskunft */
/* @var $form ActiveForm */
?>
<div class="auskunft-daten">

    <?php $form = ActiveForm::begin(); ?>
<pre>
<?php var_dump($model); ?>
</pre>
        <?= $form->field($model, 'firstName') ?>
        <?= $form->field($model, 'lastName') ?>
        <?= $form->field($model, 'street') ?>
        <?= $form->field($model, 'streetNumber') ?>
        <?= $form->field($model, 'zip') ?>
        <?= $form->field($model, 'city') ?>
        <?= $form->field($model, 'additional') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'reminder')->checkbox() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- auskunft-daten -->
