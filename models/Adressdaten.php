<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Adressdaten".
 *
 * @property integer $id
 * @property integer $idfile
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
 */
class Adressdaten extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Adressdaten';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idfile', 'quelldatei', 'name', 'branche', 'typ', 'adresse', 'plz', 'stadt', 'bundesland', 'land'], 'required'],
            [['idfile', 'plz'], 'integer'],
            [['quelldatei', 'adresse', 'stadt', 'bundesland', 'email'], 'string', 'max' => 64],
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
            'idfile' => 'Idfile',
            'quelldatei' => 'Quelldatei',
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
