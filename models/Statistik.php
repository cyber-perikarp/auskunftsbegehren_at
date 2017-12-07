<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statistik".
 *
 * @property integer $id
 * @property integer $counter
 * @property string $identifier
 */
class Statistik extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statistik';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['counter', 'identifier'], 'required'],
            [['counter'], 'integer'],
            [['identifier'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'counter' => 'Counter',
            'identifier' => 'Identifier',
        ];
    }
}
