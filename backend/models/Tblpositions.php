<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tblpositions".
 *
 * @property integer $POSIT_ID
 * @property integer $LEVELPOSIT_ID
 * @property string $POSIT_NAME
 *
 * @property Tblofficials[] $tblofficials
 * @property Tbllevelbyposition $lEVELPOSIT
 */
class Tblpositions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblpositions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LEVELPOSIT_ID', 'POSIT_NAME'], 'required'],
            [['LEVELPOSIT_ID'], 'integer'],
            [['POSIT_NAME'], 'string', 'max' => 100],
            [['LEVELPOSIT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Tbllevelbyposition::className(), 'targetAttribute' => ['LEVELPOSIT_ID' => 'LEVELPOSIT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'POSIT_ID' => 'Posit  ID',
            'LEVELPOSIT_ID' => 'Levelposit  ID',
            'POSIT_NAME' => 'Posit  Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblofficials()
    {
        return $this->hasMany(Tblofficials::className(), ['POSIT_ID' => 'POSIT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLEVELPOSIT()
    {
        return $this->hasOne(Tbllevelbyposition::className(), ['LEVELPOSIT_ID' => 'LEVELPOSIT_ID']);
    }
}
