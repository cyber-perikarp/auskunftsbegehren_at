<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reminders".
 *
 * @property integer $id
 * @property string $email
 * @property string $quelldatei
 * @property string $created_at
 * @property string $due_at
 * @property string $targets
 */
class Reminders extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reminders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [["targets", 'email', 'created_at', 'due_at'], 'required'],
            [['targets'], 'string'],
            [['created_at', 'due_at'], 'safe'],
            [['email'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'targets' => 'Ziele',
            'created_at' => 'Created At',
            'due_at' => 'Due At',
        ];
    }
}
