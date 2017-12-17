<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "generated".
 *
 * @property string $id
 * @property string $generated_at
 * @property string $todelete_at
 * @property integer $linkopened
 */
class Generated extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'generated';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'generated_at', 'todelete_at'], 'required'],
            [['generated_at', 'todelete_at'], 'safe'],
            [['linkopened'], 'integer'],
            [['id'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'generated_at' => 'Generated At',
            'todelete_at' => 'Todelete At',
            'linkopened' => 'Linkopened',
        ];
    }
}
