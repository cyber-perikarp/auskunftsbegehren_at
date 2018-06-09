<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Adressdaten */

$this->title = 'Create Adressdaten';
$this->params['breadcrumbs'][] = ['label' => 'Adressdatens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adressdaten-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
