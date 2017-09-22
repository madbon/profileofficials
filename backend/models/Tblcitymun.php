<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tblcitymun".
 *
 * @property integer $REGION_C
 * @property integer $PROVINCE_C
 * @property integer $DISTRICT_C
 * @property integer $CITYMUN_C
 * @property string $LGU_M
 * @property string $CLASS
 * @property string $URL
 * @property string $picture
 */
class Tblcitymun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblcitymun';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REGION_C', 'PROVINCE_C', 'CITYMUN_C'], 'required'],
            [['REGION_C', 'PROVINCE_C', 'DISTRICT_C', 'CITYMUN_C'], 'integer'],
            [['LGU_M'], 'string', 'max' => 50],
            [['CLASS'], 'string', 'max' => 5],
            [['URL', 'picture'], 'string', 'max' => 100],
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
            'DISTRICT_C' => 'District  C',
            'CITYMUN_C' => 'Citymun  C',
            'LGU_M' => 'Lgu  M',
            'CLASS' => 'Class',
            'URL' => 'Url',
            'picture' => 'Picture',
        ];
    }
}
