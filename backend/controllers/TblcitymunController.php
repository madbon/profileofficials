<?php

namespace backend\controllers;

use Yii;
use backend\models\Tblcitymun;

class TblcitymunController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionGetcitymun()
    {
         if(Yii::$app->request->isPost)
        {   
            $valuereg=Yii::$app->request->post("valuereg");

            $valueprov=Yii::$app->request->post("valueprov");

            print_r($valueprov);


                    $countCategory = Tblcitymun::find()->where(['=', 'REGION_C', $valuereg])
                    ->andWhere(['=','PROVINCE_C',$valueprov])
                    ->count();

                    $category = Tblcitymun::find()
                            ->where(['=', 'REGION_C', $valuereg])
                            ->andWhere(['=','PROVINCE_C',$valueprov])
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

       


       
    }





    	 // $query = new \yii\db\Query;
      //       $query->select('CITYMUN_C, LGU_M')
      //       ->from('tblcitymun')->where(['=', 'REGION_C', $regid])->andWhere(['=', 'PROVINCE_C', $provid]);
      //       $command    = $query->createCommand();
      //       $rows       = $command->queryAll();
      //       $items      = ArrayHelper::map($rows, 'CITYMUN_C', 'LGU_M');

           
}
