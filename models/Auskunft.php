<?php

namespace app\models;

/**
 * This is the model class for table "Adressdaten".
 *
 * @property string $id
 * @property string $firstName
 * @property string $lastName
 * @property string $street
 * @property string $streetNumber
 * @property integer $zip
 * @property string $city
 * @property string $email
 * @property string $additional
 * @property integer $reminder
 * @property integer $idType
 * @property string $targets
 */
class Auskunft extends BaseModel {
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auskunft';
    }

    public function rules()
    {
        return [
            [['firstName', 'lastName', 'street', 'streetNumber', 'zip', 'city', 'email', 'targets'], 'required', 'message' => '{attribute} ist ein Pflichtfeld.'],
            [['additional'], 'string', 'max' => 256, 'message' => 'Bitte geben Sie nicht mehr als 256 Zeichen ein.'],
            [['idType'], 'exist', 'targetAttribute' => 'id', 'targetClass' => IdTypes::className()],
            [['email'], 'email'],
            [['reminder'], 'default', 'value' => false],
            [['targets'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'firstName' => "Vorname",
            'lastName' => "Nachname",
            'street' => "Straße",
            'streetNumber' => "Hausnummer",
            'zip' => "Postleitzahl",
            'city' => "Stadt",
            'additional' => "Zusatsangaben",
            'idType' => "Ausweis",
            'email' => "Emailadresse",
            'reminder' => "Erinnerung",
            "targets" => "Ziele"
        ];
    }

    public function getIdTypes () {
       return IdTypes::find()->all();
    }
}