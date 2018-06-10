<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Adressdaten".
 *
 * @property string $id
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
 */
class Adressdaten extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adressdaten';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'branche', 'typ', 'adresse', 'plz', 'stadt', 'bundesland', 'land'], 'required', 'message' => '{attribute} ist ein Pflichtfeld.'],
            [['plz'], 'integer'],
            [['adresse', 'stadt', 'bundesland', 'email'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 128],
            [['branche', 'typ', 'tel', 'fax'], 'string', 'max' => 32],
            [['land'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'branche' => 'Branche',
            'typ' => 'Typ',
            'adresse' => 'Adresse',
            'plz' => 'Plz',
            'stadt' => 'Stadt',
            'bundesland' => 'Bundesland',
            'land' => 'Land',
            'email' => 'Email',
            'tel' => 'Tel',
            'fax' => 'Fax',
        ];
    }

    /**
     * @inheritdoc
     * @return AdressdatenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdressdatenQuery(get_called_class());
    }
}
