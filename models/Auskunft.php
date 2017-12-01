<?php

namespace app\models;

use yii\base\Model;

class Auskunft extends Model {
    public $firstName;
    public $lastName;
    public $street;
    public $streetNumber;
    public $zip;
    public $city;
    
    public $email;
    public $additional;
    public $reminder;
    public $idType;

    public $targets;

    public function rules()
    {
        return [
            [['firstName', 'lastName', 'street', 'streetNumber', 'zip', 'city'], 'required'],
            [['additional'], 'string', 'max' => 256],
            [['idType'], 'integer', 'max' => 2],
            ['email', 'email'],
            ['reminder', 'default', 'value' => false],
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
        ];
    }

    public function getidType()
    {
        return $this->hasOne(idTypes::className(), ['id' => 'idType']);
    }


}