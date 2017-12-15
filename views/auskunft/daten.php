<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Auskunft */
/* @var $form ActiveForm */

$this->title = "Generieren";
?>
<h1>
	Start
</h1>
<div class="auskunft-daten">
    <?php
	$form = ActiveForm::begin([
		'layout' => 'horizontal',
		'fieldConfig' => [
			'options' => [
//				'tag' => false,
			],
		],
	]);
	?>
	<div class="form-fields container"><!-- Form fields start here -->
		<div class="form-row">
			<div class="form-group col-md-6">
				<?= $form->field($model, 'firstName') ?>
			</div>
			<div class="form-group col-md-6">
				<?= $form->field($model, 'lastName') ?>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<?= $form->field($model, 'street') ?>
			</div>
			<div class="form-group col-md-6">
				<?= $form->field($model, 'streetNumber') ?>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<?= $form->field($model, 'zip') ?>
			</div>
			<div class="form-group col-md-6">
				<?= $form->field($model, 'city') ?>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<?= $form->field($model, 'idType')->dropDownList(ArrayHelper::map($idTypes, 'id', 'name')); ?>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<?= $form->field($model, 'additional')->textarea() ?>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<?= $form->field($model, 'email') ?>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<?= $form->field($model, 'reminder')->checkbox()->label("Ich möchte nach Ablauf der Frist erinnert werden") ?>
			</div>
		</div>
	</div><!-- Form fields end here -->

	<div id="ziele">
		<?php
		$i=0;
		foreach ($branchen as $branche):
			$i++;
		?>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="category<?= $i; ?>">
					<h2 class="panel-title">
						<a data-toggle="collapse" href="#collapse<?= $i; ?>" aria-expanded="false" aria-controls="collapse<?= $i; ?>">
							<?= $branche["branche"]; ?>
							<span class="badge"><?= app\models\Adressdaten::find()->where(["branche" => $branche])->select(["id"])->count(); ?></span>
						</a>
					</h2>
				</div>
				<div id="collapse<?= $i; ?>" class="collapse list-of-targets panel-body" aria-labelledby="category<?= $i; ?>" data-parent="#ziele">
					<div class="card-text">
						<table class="table table-striped table-responsive">
							<tr>
								<th>

								</th>
								<th>
									Fax
								</th>
								<th>
									Email
								</th>
								<th>
									Typ
								</th>
								<th>
									Name
								</th>
								<th>
									Ort
								</th>
							</tr>

							<?php foreach ($ziele as $ziel):
								if($ziel["branche"] == $branche["branche"]): ?>
								<tr>
									<td>
										<input type="checkbox" name="Auskunft[targets][]" value="<?= $ziel["id"]; ?>" id="<?= $ziel["id"]; ?>">
									</td>
									<?php if ($ziel["fax"]): ?>
										<td>
											<i class="fa fa-check has-contact-type"></i>
										</td>
									<?php else: ?>
										<td>
											<i class="fa fa-times hasnt-contact-type"></i>
										</td>
									<?php endif; ?>
									<?php if ($ziel["email"]): ?>
										<td>
											<i class="fa fa-check has-contact-type"></i>
										</td>
									<?php else: ?>
										<td>
											<i class="fa fa-times hasnt-contact-type"></i>
										</td>
									<?php endif; ?>
									<td>
										 <label for="<?= $ziel["id"]; ?>"><?= $ziel["typ"]; ?></label>
									</td>
									<td>
										 <label for="<?= $ziel["id"]; ?>"><?= $ziel["name"]; ?></label>
									</td>
									<td>
										 <label for="<?= $ziel["id"]; ?>"><?= $ziel["stadt"]; ?>, <?= $ziel["bundesland"]; ?></label>
									</td>
								</tr>
								<?php
								endif;
							endforeach;
						?>
						</table>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>


	<div class="form-group">
		<?= Html::submitButton('Absenden!', ['class' => 'btn btn-primary']) ?>
	</div>
<?php ActiveForm::end(); ?>

</div><!-- auskunft-daten -->

