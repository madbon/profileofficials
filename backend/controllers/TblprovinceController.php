<?php

namespace backend\controllers;

use backend\models\Tblprovince;
use backend\models\Tblregion;

class TblprovinceController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLists($id)
    {
        $countCategory = Tblprovince::find()
                ->where(['REGION_C' => $id])
                ->count();
        $category = Tblprovince::find()
                ->where(['REGION_C' => $id])
                ->all();
        if($countCategory > 0)
        {
            foreach($category as $categ){
                echo "<option value='".$categ->PROVINCE_C."'>".$categ->LGU_M."</option>";
            }
        }
        else
        {
            echo "<option> - </option>";
        }
    }

}
