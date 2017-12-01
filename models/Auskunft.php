<?php

namespace app\models;

use Yii;

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
            [['firstName', 'lastName', 'street', 'streetNumber', 'zip', 'city'], 'required', 'string', 'max' => 64],
            [['additional'], 'string', 'max' => 256],
            [['idType'], 'integer', 'max' => 2],
            ['email', 'email'],
            ['reminder', 'default', 'value' => false],
        ];
    }
}