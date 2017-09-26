<?php

namespace backend\controllers;

use Yii;
use backend\models\Tblofficials;
use backend\models\TblofficialsSearch;
use backend\models\Tbllevelbyposition;
use backend\models\Tblparty;
use backend\models\Tblpositions;
use backend\models\Tblregion;
use backend\models\Tblprovince;
use backend\models\Tblcitymun;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

use yii\helpers\BaseStringHelper;
/**
 * TblofficialsController implements the CRUD actions for Tblofficials model.
 */
class TblofficialsController extends Controller
{

    function getFloatFromString($string) {
     return (float) preg_replace('/[^0-9.]/', '', $string);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }



    /**
     * Lists all Tblofficials models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblofficialsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Tblofficials();
        $queryregion = Tblregion::find()->all();

        $bday = $model->BIRTHDATE;
        $curYear = date('Y');
        $curMonth = date('m');
        $curDay = date('d');
        // $curDate = strotime($curYear."-". $curMonth."-" .$curDay);
        $diff30 = $curYear - 30;
        $diff50 = $curYear - 50;


        // -------- Governors and Mayors Age is BELOW 30
        $queryCountGovernor= TblofficialsSearch::find()->where(['>','DATE_FORMAT(BIRTHDATE,"%Y")',$diff30])->andWhere(['=', 'POSIT_ID', '1'])->count(); // GOVERNORS
        $govResultFloat = TblofficialsController::getFloatFromString($queryCountGovernor);
        
        $queryCountCityMayor = TblofficialsSearch::find()->where(['>','DATE_FORMAT(BIRTHDATE,"%Y")',$diff30])->andWhere(['=', 'POSIT_ID', '4'])->count(); // CITY MAYORS
        $citymayorResultFloat = TblofficialsController::getFloatFromString($queryCountCityMayor);
        
        $queryCountMunMayor = TblofficialsSearch::find()->where(['>','DATE_FORMAT(BIRTHDATE,"%Y")',$diff30])->andWhere(['=', 'POSIT_ID', '7'])->count(); // MUNICIPAL MAYORS
        $munmayorResultFloat = TblofficialsController::getFloatFromString($queryCountMunMayor);

        // ---------- Governors and Mayors Age is BETWEEN 30 and 50
        $queryCountGovernorBet = TblofficialsSearch::find()->where(['between','DATE_FORMAT(BIRTHDATE,"%Y")',$diff50,$diff30])->andWhere(['=', 'POSIT_ID', '1'])->count();// GOVERNORS
        $govResultFloatBet = TblofficialsController::getFloatFromString($queryCountGovernorBet);

        $queryCountCityMayorBet = TblofficialsSearch::find()->where(['between','DATE_FORMAT(BIRTHDATE,"%Y")',$diff50,$diff30])->andWhere(['=', 'POSIT_ID', '4'])->count(); // CITY MAYORS
        $citymayorResultFloatBet = TblofficialsController::getFloatFromString($queryCountCityMayorBet);

        $queryCountMunMayotBet = TblofficialsSearch::find()->where(['between','DATE_FORMAT(BIRTHDATE,"%Y")',$diff50,$diff30])->andWhere(['=', 'POSIT_ID', '7'])->count();/// MUNICIPAL MAYORS
        $munmayorResultFloatBet = TblofficialsController::getFloatFromString($queryCountMunMayotBet);

        // ---------- Governors and Mayors Age is BETWEEN 30 and 50
        $queryCountGovernorAbove = TblofficialsSearch::find()->where(['<','DATE_FORMAT(BIRTHDATE,"%Y")',$diff50])->andWhere(['=', 'POSIT_ID', '1'])->count();// GOVERNORS
        $govResultFloatAbove = TblofficialsController::getFloatFromString($queryCountGovernorAbove);

        $queryCountCityMayorAbove = TblofficialsSearch::find()->where(['<','DATE_FORMAT(BIRTHDATE,"%Y")',$diff50])->andWhere(['=', 'POSIT_ID', '4'])->count(); // CITY MAYORS
        $citymayorResultFloatAbove = TblofficialsController::getFloatFromString($queryCountCityMayorAbove);

        $queryCountMunMayorAbove = TblofficialsSearch::find()->where(['<','DATE_FORMAT(BIRTHDATE,"%Y")',$diff50])->andWhere(['=', 'POSIT_ID', '7'])->count();// MUNICIPAL MAYORS
        $munmayorResultFloatAbove = TblofficialsController::getFloatFromString($queryCountMunMayorAbove);


        // Statistic by POLITICAL PARTY AFFILIATION
         $queryPieGraph = tblparty::find()->select(['PARTY_NAME as Polparty', '(SELECT COUNT(PARTY_ID) FROM tblofficials WHERE POSIT_ID = 4 AND PARTY_ID = tblparty.PARTY_ID) as count'])->asArray()->all();
        
        $datapie = array();
        foreach ($queryPieGraph as $forpiedata) {
          $datapie[] = [
                        'name' => $forpiedata["Polparty"],
                        'y' => TblofficialsController::getFloatFromString($forpiedata["count"]),
                     ];
        }



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'queryregion'=> $queryregion,
            // 'searchModel1'=>$searchModel1,
            // 'dataProvider1'=>$dataProvider1,
            'queryCountGovernor' => $govResultFloat,
            'queryCountCityMayor' => $citymayorResultFloat,
            'queryCountMunMayor' => $munmayorResultFloat,
            'govResultFloatBet' => $govResultFloatBet,
            'citymayorResultFloatBet' => $citymayorResultFloatBet,
            'munmayorResultFloatBet' => $munmayorResultFloatBet,
            'govResultFloatAbove' => $govResultFloatAbove,
            'citymayorResultFloatAbove' => $citymayorResultFloatAbove,
            'munmayorResultFloatAbove' => $munmayorResultFloatAbove,
            'datapie' => $datapie,

            // 'countOfficials' => $countOfficials,
        ]);
    }

    /**
     * Displays a single Tblofficials model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

     /**
     * Displays a single Tblofficials model.
     * @param integer $id
     * @return mixed
     */
    public function actionStatistics()
    {
        $searchModel = new TblofficialsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Tblofficials();
        $queryregion = Tblregion::find()->all();

        $bday = $model->BIRTHDATE;
        $curYear = date('Y');
        $curMonth = date('m');
        $curDay = date('d');
        // $curDate = strotime($curYear."-". $curMonth."-" .$curDay);
        $diff30 = $curYear - 30;
        $diff50 = $curYear - 50;


        // -------- Governors and Mayors Age is BELOW 30
        $queryCountGovernor= TblofficialsSearch::find()->where(['>','DATE_FORMAT(BIRTHDATE,"%Y")',$diff30])->andWhere(['=', 'POSIT_ID', '1'])->count(); // GOVERNORS
        $govResultFloat = TblofficialsController::getFloatFromString($queryCountGovernor);
        
        $queryCountCityMayor = TblofficialsSearch::find()->where(['>','DATE_FORMAT(BIRTHDATE,"%Y")',$diff30])->andWhere(['=', 'POSIT_ID', '4'])->count(); // CITY MAYORS
        $citymayorResultFloat = TblofficialsController::getFloatFromString($queryCountCityMayor);
        
        $queryCountMunMayor = TblofficialsSearch::find()->where(['>','DATE_FORMAT(BIRTHDATE,"%Y")',$diff30])->andWhere(['=', 'POSIT_ID', '7'])->count(); // MUNICIPAL MAYORS
        $munmayorResultFloat = TblofficialsController::getFloatFromString($queryCountMunMayor);

        // ---------- Governors and Mayors Age is BETWEEN 30 and 50
        $queryCountGovernorBet = TblofficialsSearch::find()->where(['between','DATE_FORMAT(BIRTHDATE,"%Y")',$diff50,$diff30])->andWhere(['=', 'POSIT_ID', '1'])->count();// GOVERNORS
        $govResultFloatBet = TblofficialsController::getFloatFromString($queryCountGovernorBet);

        $queryCountCityMayorBet = TblofficialsSearch::find()->where(['between','DATE_FORMAT(BIRTHDATE,"%Y")',$diff50,$diff30])->andWhere(['=', 'POSIT_ID', '4'])->count(); // CITY MAYORS
        $citymayorResultFloatBet = TblofficialsController::getFloatFromString($queryCountCityMayorBet);

        $queryCountMunMayotBet = TblofficialsSearch::find()->where(['between','DATE_FORMAT(BIRTHDATE,"%Y")',$diff50,$diff30])->andWhere(['=', 'POSIT_ID', '7'])->count();/// MUNICIPAL MAYORS
        $munmayorResultFloatBet = TblofficialsController::getFloatFromString($queryCountMunMayotBet);

        // ---------- Governors and Mayors Age is BETWEEN 30 and 50
        $queryCountGovernorAbove = TblofficialsSearch::find()->where(['<','DATE_FORMAT(BIRTHDATE,"%Y")',$diff50])->andWhere(['=', 'POSIT_ID', '1'])->count();// GOVERNORS
        $govResultFloatAbove = TblofficialsController::getFloatFromString($queryCountGovernorAbove);

        $queryCountCityMayorAbove = TblofficialsSearch::find()->where(['<','DATE_FORMAT(BIRTHDATE,"%Y")',$diff50])->andWhere(['=', 'POSIT_ID', '4'])->count(); // CITY MAYORS
        $citymayorResultFloatAbove = TblofficialsController::getFloatFromString($queryCountCityMayorAbove);

        $queryCountMunMayorAbove = TblofficialsSearch::find()->where(['<','DATE_FORMAT(BIRTHDATE,"%Y")',$diff50])->andWhere(['=', 'POSIT_ID', '7'])->count();// MUNICIPAL MAYORS
        $munmayorResultFloatAbove = TblofficialsController::getFloatFromString($queryCountMunMayorAbove);


        // Statistic by POLITICAL PARTY AFFILIATION
         $queryPieGraph = tblparty::find()->select(['PARTY_NAME as Polparty', '(SELECT COUNT(PARTY_ID) FROM tblofficials WHERE POSIT_ID = 4 AND PARTY_ID = tblparty.PARTY_ID) as count'])->asArray()->all();
        
        $datapie = array();
        foreach ($queryPieGraph as $forpiedata) {
          $datapie[] = [
                        'name' => $forpiedata["Polparty"],
                        'y' => TblofficialsController::getFloatFromString($forpiedata["count"]),
                     ];
        }



        return $this->render('statistics', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'queryregion'=> $queryregion,
            'queryCountGovernor' => $govResultFloat,
            'queryCountCityMayor' => $citymayorResultFloat,
            'queryCountMunMayor' => $munmayorResultFloat,
            'govResultFloatBet' => $govResultFloatBet,
            'citymayorResultFloatBet' => $citymayorResultFloatBet,
            'munmayorResultFloatBet' => $munmayorResultFloatBet,
            'govResultFloatAbove' => $govResultFloatAbove,
            'citymayorResultFloatAbove' => $citymayorResultFloatAbove,
            'munmayorResultFloatAbove' => $munmayorResultFloatAbove,
            'datapie' => $datapie,

            // 'countOfficials' => $countOfficials,
        ]);
    }

    /**
     * Creates a new Tblofficials model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tblofficials();

        // $levelbyplace = Tbllevelbyplace::find()->all();
        $querylevelbyposition = Tbllevelbyposition::find()->all();
        $party = Tblparty::find()->all();
        $queryposition = Tblpositions::find()->all();
        $queryregion = Tblregion::find()->all();
        $queryprovince = Tblprovince::find()->all();
        $querycitymun = Tblcitymun::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->OFFICIAL_ID]);
        } else {

          
            return $this->render('create', [
                'model' => $model,
                'arrlevelbyposition'=>ArrayHelper::map($querylevelbyposition,'LEVELPOSIT_ID','LEVELPOSIT_NAME'),
                'querylevelbyposition' => $querylevelbyposition,
                'party'=>ArrayHelper::map($party,'PARTY_ID','PARTY_NAME'),
                'queryposition'=> $queryposition,
                'queryregion'=> $queryregion,
                'queryprovince' => $queryprovince,
                'querycitymun' => $querycitymun,
            ]);
        }
    }

    /**
     * Updates an existing Tblofficials model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $querylevelbyposition = Tbllevelbyposition::find()->all();
        $party = Tblparty::find()->all();
        $queryposition = Tblpositions::find()->all();
        $queryregion = Tblregion::find()->all();
        $queryprovince = Tblprovince::find()->all();
        $querycitymun = Tblcitymun::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->OFFICIAL_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'arrlevelbyposition'=>ArrayHelper::map($querylevelbyposition,'LEVELPOSIT_ID','LEVELPOSIT_NAME'),
                'querylevelbyposition' => $querylevelbyposition,
                'party'=>ArrayHelper::map($party,'PARTY_ID','PARTY_NAME'),
                'queryposition'=> $queryposition,
                'queryregion'=> $queryregion,
                'queryprovince' => $queryprovince,
                'querycitymun' => $querycitymun,
            ]);
        }
    }

    /**
     * Deletes an existing Tblofficials model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

   

    /**
     * Finds the Tblofficials model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tblofficials the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tblofficials::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
