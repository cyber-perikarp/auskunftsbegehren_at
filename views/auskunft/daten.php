<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Auskunft */
/* @var $form ActiveForm */

$this->title = "Generieren";
?>
<div class="auskunft-daten">
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

        <?= $form->field($model, 'firstName') ?>
        <?= $form->field($model, 'lastName') ?>
        <?= $form->field($model, 'street') ?>
        <?= $form->field($model, 'streetNumber') ?>
        <?= $form->field($model, 'zip') ?>
        <?= $form->field($model, 'city') ?>
        <?= $form->field($model, 'idType')->dropDownList(ArrayHelper::map($idTypes, 'id', 'name')); ?>
        <?= $form->field($model, 'additional')->textarea() ?>

        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'reminder')->checkbox() ?>



        <?php
		$i=0;
        foreach ($branchen as $branche) { ?>
			<div id="ziele" role="tablist">
				<div class="card">
					<div class="card-body">
						<div class="card-header" role="tab" id="category<?php echo $i; ?>">
							<h2 class="mb-0 card-title">
								<a data-toggle="collapse" href="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
									<?php echo($branche["branche"]); ?>
								</a>
							</h2>
						</div>
						<div id="collapse<?php echo $i; ?>" class="collapse list-of-targets" role="tabpanel" aria-labelledby="category<?php echo $i; ?>" data-parent="#ziele">
							<div class="card-text">
								<table class="table table-striped table-responsive">
									<tr>
										<th>

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

									<?php foreach ($ziele as $ziel) {
										if($ziel["branche"] == $branche["branche"]) { ?>
										<tr>
											<td>
												<input type="checkbox" name="Auskunft[targets][]" value="<?php echo($ziel["id"]); ?>" id="<?php echo($ziel["id"]); ?>">
											</td>

											<td>
												 <label for="<?php echo($ziel["id"]); ?>"><?php echo($ziel["typ"]); ?></label>
											</td>
											<td>
												 <label for="<?php echo($ziel["id"]); ?>"><?php echo($ziel["name"]); ?></label>
											</td>
											<td>
												 <label for="<?php echo($ziel["id"]); ?>"><?php echo($ziel["stadt"]); ?>, <?php echo($ziel["bundesland"]); ?></label>
											</td>
										</tr>
										<?php
										}
									}
								?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
			$i++;
        }
        ?>


        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- auskunft-daten -->

