<?php

namespace backend\controllers;

use backend\models\Tbllevelbyposition;
use backend\models\Tblpositions;

class TblpositionsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

 	public function actionLists($id)
    {
        $countCategory = Tblpositions::find()
                ->where(['LEVELPOSIT_ID' => $id])
                ->count();
        $category = Tblpositions::find()
                ->where(['LEVELPOSIT_ID' => $id])
                ->all();
        if($countCategory > 0)
        {
            foreach($category as $categ){
                echo "<option value='".$categ->POSIT_ID."'>".$categ->POSIT_NAME."</option>";
            }
        }
        else
        {
            echo "<option> - </option>";
        }
    }
}
