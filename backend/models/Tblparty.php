<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tblparty".
 *
 * @property integer $PARTY_ID
 * @property string $PARTY_NAME
 * @property string $PARTY_ABBR
 *
 * @property Tblofficials[] $tblofficials
 */
class Tblparty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblparty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PARTY_NAME', 'PARTY_ABBR'], 'required'],
            [['PARTY_NAME'], 'string', 'max' => 100],
            [['PARTY_ABBR'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PARTY_ID' => 'Party  ID',
            'PARTY_NAME' => 'Party  Name',
            'PARTY_ABBR' => 'Party  Abbr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblofficials()
    {
        return $this->hasMany(Tblofficials::className(), ['PARTY_ID' => 'PARTY_ID']);
    }
}
