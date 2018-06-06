<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

/**
 * This is the model class for table "Adressdaten".
 *
 * @property string $id
 * @property string $quelldatei
 * @property string $name
 * @property string $branche
 * @property string $typ
 * @property string $adresse
 * @property integer $plz
 * @property string $stadt
 * @property string $bundesland
 * @property string $land
 * @property string $email
 * @property string $tel
 * @property string $fax
 * @property string $verifyCode
 */
class AdressdatenSuggest extends Adressdaten
{
    public $captcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['captcha', 'required'];
        $rules[] = ['captcha', 'captcha'];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['captcha'] = 'Verify that you are alive';
        return $attributeLabels;
    }
}
