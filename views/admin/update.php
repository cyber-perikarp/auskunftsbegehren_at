<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Adressdaten */

$this->title = 'Update Adressdaten: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Adressdatens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="adressdaten-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
