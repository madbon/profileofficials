<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbllevelbyposition".
 *
 * @property integer $LEVELPOSIT_ID
 * @property string $LEVELPOSIT_NAME
 *
 * @property Tblofficials[] $tblofficials
 * @property Tblpositions[] $tblpositions
 */
class Tbllevelbyposition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbllevelbyposition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LEVELPOSIT_NAME'], 'required'],
            [['LEVELPOSIT_NAME'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LEVELPOSIT_ID' => 'Levelposit  ID',
            'LEVELPOSIT_NAME' => 'Levelposit  Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblofficials()
    {
        return $this->hasMany(Tblofficials::className(), ['LEVELPOSIT_ID' => 'LEVELPOSIT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblpositions()
    {
        return $this->hasMany(Tblpositions::className(), ['LEVELPOSIT_ID' => 'LEVELPOSIT_ID']);
    }
}
