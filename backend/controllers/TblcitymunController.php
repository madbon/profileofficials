<?php

namespace backend\controllers;

use backend\models\Tblcitymun;

class TblcitymunController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionLists($id)
    {
        $countCategory = Tblcitymun::find()
                ->where(['=', 'REGION_C', $id])->andWhere(['=','PROVINCE_C',$id])
                ->count();
        $category = Tblcitymun::find()
                ->where(['=', 'REGION_C', $id])->andWhere(['=','PROVINCE_C',$id])
                ->all();
        if($countCategory > 0)
        {
            foreach($category as $categ){
                echo "<option value='".$categ->CITYMUN_C."'>".$categ->LGU_M."</option>";
            }
        }
        else
        {
            echo "<option> - </option>";
        }
    }





    	 // $query = new \yii\db\Query;
      //       $query->select('CITYMUN_C, LGU_M')
      //       ->from('tblcitymun')->where(['=', 'REGION_C', $regid])->andWhere(['=', 'PROVINCE_C', $provid]);
      //       $command    = $query->createCommand();
      //       $rows       = $command->queryAll();
      //       $items      = ArrayHelper::map($rows, 'CITYMUN_C', 'LGU_M');

           
}
