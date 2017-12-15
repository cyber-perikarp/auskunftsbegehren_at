<?php

namespace app\models;

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
            [['firstName', 'lastName', 'street', 'streetNumber', 'zip', 'city', 'email'], 'required', 'message' => 'Dieses Feld ist ein Pflichtfeld.'],
            [['additional'], 'string', 'max' => 256, 'message' => 'Bitte geben Sie nicht mehr als 256 Zeichen ein.'],
            [['idType'], 'exist', 'targetAttribute' => 'id', 'targetClass' => IdTypes::className()],
            [['email'], 'email'],
            [['reminder'], 'default', 'value' => false],
            [['targets'], 'safe']
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