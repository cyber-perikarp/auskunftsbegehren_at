<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "idTypes".
 *
 * @property integer $id
 * @property string $name
 * @property string $nameForText
 */
class IdTypes extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'idTypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'nameForText'], 'required'],
            [['name', 'nameForText'], 'string', 'max' => 64],
        ];
    }
}
