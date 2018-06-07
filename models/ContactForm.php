<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for the Contact-Form.
 *
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property string $verifyCode
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body', 'verifyCode'], 'required'],
            ['verifyCode', 'captcha'],
            ['email', 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'email' => 'E-Mail',
            'subject' => 'Betreff',
            'body' => 'Nachricht',
            'verifyCode' => 'Captcha'
        ];
    }
}