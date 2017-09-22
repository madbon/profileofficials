<?php

namespace backend\controllers;

use Yii;
use backend\models\Tblofficials;
use backend\models\TblofficialsSearch;
use backend\models\Tbllevelbyplace;
use backend\models\Tbllevelbyposition;
use backend\models\Tblparty;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * TblofficialsController implements the CRUD actions for Tblofficials model.
 */
class TblofficialsController extends Controller
{
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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
     * Creates a new Tblofficials model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tblofficials();

        $levelbyplace = Tbllevelbyplace::find()->all();
        $levelbyposition = Tbllevelbyposition::find()->all();
        $party = Tblparty::find()->all();
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->OFFICIAL_ID]);
        } else {

          
            return $this->render('create', [
                'model' => $model,
                'levelbyplace'=>ArrayHelper::map($levelbyplace,'LEVELPLACE_ID','LEVELPLACE_NAME'),
                'levelbyposition'=>ArrayHelper::map($levelbyposition,'LEVELPOSIT_ID','LEVELPOSIT_NAME'),
                'party'=>ArrayHelper::map($party,'PARTY_ID','PARTY_NAME'),
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->OFFICIAL_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
