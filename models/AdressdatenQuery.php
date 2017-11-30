<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Adressdaten]].
 *
 * @see Adressdaten
 */
class AdressdatenQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Adressdaten[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Adressdaten|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
