<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbllevelbyplace".
 *
 * @property integer $LEVELPLACE_ID
 * @property string $LEVELPLACE_NAME
 *
 * @property Tblofficials[] $tblofficials
 */
class Tbllevelbyplace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbllevelbyplace';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LEVELPLACE_NAME'], 'required'],
            [['LEVELPLACE_NAME'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LEVELPLACE_ID' => 'Levelplace  ID',
            'LEVELPLACE_NAME' => 'Levelplace  Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblofficials()
    {
        return $this->hasMany(Tblofficials::className(), ['LEVELPLACE_ID' => 'LEVELPLACE_ID']);
    }
}
