<?php
namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class BaseModel extends \yii\db\ActiveRecord {
	use SoftDeleteTrait;

	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'value' => new Expression('NOW()'),
			],
		];
	}

	public static function find() {
		return new BaseQuery(get_called_class());
	}
}