<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tblregion".
 *
 * @property integer $REGION_C
 * @property string $REGION_M
 * @property integer $sort
 * @property string $REGION_M_SHORT
 */
class Tblregion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblregion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REGION_C', 'REGION_M'], 'required'],
            [['REGION_C', 'sort'], 'integer'],
            [['REGION_M'], 'string', 'max' => 50],
            [['REGION_M_SHORT'], 'string', 'max' => 10],
            [['REGION_C'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REGION_C' => 'Region  C',
            'REGION_M' => 'Region  M',
            'sort' => 'Sort',
            'REGION_M_SHORT' => 'Region  M  Short',
        ];
    }
}
