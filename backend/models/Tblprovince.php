<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tblprovince".
 *
 * @property integer $REGION_C
 * @property integer $PROVINCE_C
 * @property string $LGU_M
 * @property string $CLASS
 */
class Tblprovince extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblprovince';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REGION_C', 'PROVINCE_C'], 'integer'],
            [['PROVINCE_C'], 'required'],
            [['LGU_M'], 'string', 'max' => 50],
            [['CLASS'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REGION_C' => 'Region  C',
            'PROVINCE_C' => 'Province  C',
            'LGU_M' => 'Lgu  M',
            'CLASS' => 'Class',
        ];
    }
}
