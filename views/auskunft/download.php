<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = "Download";
?>
<h1>auskunft/download</h1>
<p>
    Yay, Drück auf download!
</p>
<p>
    <a href="<?= Url::to(['auskunft/downloadstart', 'id' => $id]); ?>">
		<button type="button" class="btn btn-primary">
			Download
		</button>
	</a>
</p>
