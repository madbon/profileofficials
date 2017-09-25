<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tblofficials".
 *
 * @property integer $OFFICIAL_ID
 * @property string $FIRSTNAME
 * @property string $MIDDLENAME
 * @property string $LASTNAME
 * @property string $BIRTHDATE
 * @property string $AGE
 * @property integer $LEVELPLACE_ID
 * @property integer $LEVELPOSIT_ID
 * @property integer $POSIT_ID
 * @property integer $PARTY_ID
 * @property integer $REGION_C
 * @property integer $PROVINCE_C
 * @property integer $CITYMUN_C
 * @property string $DATECREATED
 *
 * @property Tblpositions $pOSIT
 * @property Tblparty $pARTY
 * @property Tbllevelbyplace $lEVELPLACE
 * @property Tbllevelbyposition $lEVELPOSIT
 */
class Tblofficials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblofficials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FIRSTNAME', 'MIDDLENAME', 'LASTNAME', 'BIRTHDATE', 'AGE', 'LEVELPLACE_ID', 'LEVELPOSIT_ID', 'POSIT_ID', 'PARTY_ID', 'REGION_C', 'PROVINCE_C', 'CITYMUN_C'], 'required'],
            [['LEVELPLACE_ID', 'LEVELPOSIT_ID', 'POSIT_ID', 'PARTY_ID', 'REGION_C', 'PROVINCE_C', 'CITYMUN_C'], 'integer'],
            [['DATECREATED'], 'safe'],
            [['FIRSTNAME', 'MIDDLENAME', 'LASTNAME', 'BIRTHDATE', 'AGE'], 'string', 'max' => 50],
            [['POSIT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Tblpositions::className(), 'targetAttribute' => ['POSIT_ID' => 'POSIT_ID']],
            [['PARTY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Tblparty::className(), 'targetAttribute' => ['PARTY_ID' => 'PARTY_ID']],
            [['LEVELPLACE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Tbllevelbyplace::className(), 'targetAttribute' => ['LEVELPLACE_ID' => 'LEVELPLACE_ID']],
            [['LEVELPOSIT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Tbllevelbyposition::className(), 'targetAttribute' => ['LEVELPOSIT_ID' => 'LEVELPOSIT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OFFICIAL_ID' => 'Official  ID',
            'FIRSTNAME' => 'Firstname',
            'MIDDLENAME' => 'Middlename',
            'LASTNAME' => 'Lastname',
            'BIRTHDATE' => 'Birthdate',
            'AGE' => 'Age',
            'LEVELPLACE_ID' => 'Place',
            'LEVELPOSIT_ID' => 'Level by position',
            'POSIT_ID' => 'Position Title',
            'PARTY_ID' => 'Party Affiliation',
            'REGION_C' => 'Region',
            'PROVINCE_C' => 'Province',
            'CITYMUN_C' => 'City/Municipality',
            'DATECREATED' => 'Datecreated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPOSIT()
    {
        return $this->hasOne(Tblpositions::className(), ['POSIT_ID' => 'POSIT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPARTY()
    {
        return $this->hasOne(Tblparty::className(), ['PARTY_ID' => 'PARTY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLEVELPLACE()
    {
        return $this->hasOne(Tbllevelbyplace::className(), ['LEVELPLACE_ID' => 'LEVELPLACE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLEVELPOSIT()
    {
        return $this->hasOne(Tbllevelbyposition::className(), ['LEVELPOSIT_ID' => 'LEVELPOSIT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREGION()
    {
        return $this->hasOne(Tblregion::className(), ['REGION_C' => 'REGION_C']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROVINCE()
    {
        return $this->hasOne(Tblprovince::className(), ['PROVINCE_C' => 'PROVINCE_C']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCITYMUN()
    {
        return $this->hasOne(Tblcitymun::className(), ['REGION_C' => 'REGION_C','PROVINCE_C' => 'PROVINCE_C','CITYMUN_C'=>'CITYMUN_C']);
    }
}
