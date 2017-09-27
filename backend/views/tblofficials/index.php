<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Tblparty;
use backend\models\Tblregion;
use backend\models\Tblprovince;
use backend\models\Tblcitymun;
use backend\models\Tbllevelbyplace;
use backend\models\Tbllevelbyposition;
use backend\models\Tblpositions;
use miloschuman\highcharts\Highcharts;
use yii\helpers\BaseStringHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TblofficialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Local Officials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblofficials-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Local Officials', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'OFFICIAL_ID',
            'FIRSTNAME',
            'MIDDLENAME',
            'LASTNAME',
            'BIRTHDATE',
              [
              'label' => 'Age',
              'attribute' => 'age',
              'value' => function($model){
                $age = date('m') - date('m',strtotime($model->BIRTHDATE));
                if($age > 0){
                    $age = date('Y') - date('Y',strtotime($model->BIRTHDATE));
                }
                else{
                    if($age < 0){
                        $age = date('Y') - date('Y',strtotime($model->BIRTHDATE)) - 1;
                    }
                    else{
                        $age = date('d') - date('d',strtotime($model->BIRTHDATE));
                        if($age < 0){
                            $age = date('Y') - date('Y',strtotime($model->BIRTHDATE)) - 1;
                        }
                        else{
                            $age = date('Y') - date('Y',strtotime($model->BIRTHDATE));    
                        }
                    }
                }
                return $age;
              },
            ],
            // 'AGE',
            [
                'attribute' => 'LEVELPOSIT_ID',
                'value' => 'lEVELPOSIT.LEVELPOSIT_NAME',
                'filter'=>ArrayHelper::map(Tbllevelbyposition::find()->asArray()->all(), 'LEVELPOSIT_ID', 'LEVELPOSIT_NAME'),
            ],
            [
                'attribute' => 'POSIT_ID',
                'value' => 'pOSIT.POSIT_NAME',
                'filter'=>ArrayHelper::map(Tblpositions::find()->asArray()->all(), 'POSIT_ID', 'POSIT_NAME'),
            ],
            // [
            //     'attribute' => 'PARTY_ID',
            //     'value' => 'pARTY.PARTY_NAME',
            //     'filter'=>ArrayHelper::map(Tblparty::find()->asArray()->all(), 'PARTY_ID', 'PARTY_NAME'),
            // ],
            [
                'attribute' => 'PARTY_ID',
                'value' => 'pARTY.PARTY_NAME',
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'PARTY_ID',
                    'data' =>ArrayHelper::map(Tblparty::find()->asArray()->all(), 'PARTY_ID', 'PARTY_NAME'),
                    'options' => ['placeholder' => 'Select a political party ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            // [
            //     'attribute' => 'REGION_C',
            //     'value' => 'rEGION.REGION_M',
            //     'filter'=>ArrayHelper::map(Tblregion::find()->asArray()->all(), 'REGION_C', 'REGION_M'),
            // ],
            [
                'attribute' => 'REGION_C',
                'value' => 'rEGION.REGION_M',
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'REGION_C',
                    'data' => ArrayHelper::map(Tblregion::find()->asArray()->all(), 'REGION_C', 'REGION_M'),
                    'options' => ['placeholder' => 'Select a region ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            // [
            //     'attribute' => 'PROVINCE_C',
            //     'value' => 'pROVINCE.LGU_M',
            //     'filter'=>ArrayHelper::map(Tblprovince::find()->asArray()->all(), 'PROVINCE_C', 'LGU_M'),
            // ],
            [
                'attribute' => 'PROVINCE_C',
                'value' => 'pROVINCE.LGU_M',
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'PROVINCE_C',
                    'data' => ArrayHelper::map(Tblprovince::find()->asArray()->all(), 'PROVINCE_C', 'LGU_M'),
                    'options' => ['placeholder' => 'Select a province ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            
            //  [
            //     'attribute' => 'CITYMUN_C',
            //     'value' => 'cITYMUN.LGU_M',
            //     'filter'=>ArrayHelper::map(Tblcitymun::find()->asArray()->all(), 'CITYMUN_C', 'LGU_M'),
            // ],
            [
                'attribute' => 'CITYMUN_C',
                'value' => 'cITYMUN.LGU_M',
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'CITYMUN_C',
                    'data' => ArrayHelper::map(Tblcitymun::find()->asArray()->all(), 'CITYMUN_C', 'LGU_M'),
                    'options' => ['placeholder' => 'Select a city/municipality ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            // 'DATECREATED',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

 <!-- http://www.yiiframework.com/forum/index.php/topic/54011-dynamic-data-of-column-with-drilldown-yii-highcharts -->
<?php

// print_r($dataPie);


?>
