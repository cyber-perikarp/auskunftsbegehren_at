<?php

namespace app\models;

use Yii;

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
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        // TODO: Fix Validation, says no but should be ok
        // TODO: Add REAL Telephone Validation

        $rules = parent::rules();
        $rules[] = [['verifyCode', 'tel'], 'required'];
        $rules[] = ['verifyCode', 'captcha', 'captchaAction' =>'auskunft/captcha'];
        $rules[] = [['fax', 'tel'], 'match', 'pattern'=>'/^\+43[0-9]+$/'];
        $rules[] = ['email', 'email'];
        $rules[] = [['fax', 'email'], 'mailOrFax', 'skipOnEmpty' => false];
        return $rules;
    }

    public function mailOrFax($attributeName)
    {
        if (empty($this->fax) && empty($this->email)
        ) {
            $this->addError($attributeName, 'Either Email or Fax must be filled up properly');

            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['verifyCode'] = 'Captcha';
        return $attributeLabels;
    }

    /**
     * @inheritdoc
     */
    public function save($runValidation = true, $attributeNames = NULL)
    {
        return parent::save($runValidation, $attributeNames);
    }
}
