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
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TblofficialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tblofficials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblofficials-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tblofficials', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'AGE',
            [
                'attribute' => 'LEVELPLACE_ID',
                'value' => 'lEVELPLACE.LEVELPLACE_NAME',
                'filter'=>ArrayHelper::map(Tbllevelbyplace::find()->asArray()->all(), 'LEVELPLACE_ID', 'LEVELPLACE_NAME'),
            ],
            [
                'attribute' => 'LEVELPOSIT_ID',
                'value' => 'lEVELPOSIT.LEVELPOSIT_NAME',
            ],
            [
                'attribute' => 'POSIT_ID',
                'value' => 'pOSIT.POSIT_NAME',
            ],
            [
                'attribute' => 'PARTY_ID',
                'value' => 'pARTY.PARTY_NAME',
                'filter'=>ArrayHelper::map(Tblparty::find()->asArray()->all(), 'PARTY_ID', 'PARTY_NAME'),
            ],
            [
                'attribute' => 'REGION_C',
                'value' => 'rEGION.REGION_M',
                'filter'=>ArrayHelper::map(Tblregion::find()->asArray()->all(), 'REGION_C', 'REGION_M'),
            ],
            [
                'attribute' => 'PROVINCE_C',
                'value' => 'pROVINCE.LGU_M',
                'filter'=>ArrayHelper::map(Tblprovince::find()->asArray()->all(), 'PROVINCE_C', 'LGU_M'),
            ],
             [
                'attribute' => 'CITYMUN_C',
                'value' => 'cITYMUN.LGU_M',
                'filter'=>ArrayHelper::map(Tblcitymun::find()->asArray()->all(), 'CITYMUN_C', 'LGU_M'),
            ],
            // 'DATECREATED',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider1,
        'filterModel' => $searchModel1,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'OFFICIAL_ID',
            'FIRSTNAME',
            'MIDDLENAME',
            'LASTNAME',
            'BIRTHDATE',
            // 'AGE',
            [
                'attribute' => 'LEVELPLACE_ID',
                'value' => 'lEVELPLACE.LEVELPLACE_NAME',
                'filter'=>ArrayHelper::map(Tbllevelbyplace::find()->asArray()->all(), 'LEVELPLACE_ID', 'LEVELPLACE_NAME'),
            ],
            [
                'attribute' => 'LEVELPOSIT_ID',
                'value' => 'lEVELPOSIT.LEVELPOSIT_NAME',
            ],
            [
                'attribute' => 'POSIT_ID',
                'value' => 'pOSIT.POSIT_NAME',
            ],
            [
                'attribute' => 'PARTY_ID',
                'value' => 'pARTY.PARTY_NAME',
                'filter'=>ArrayHelper::map(Tblparty::find()->asArray()->all(), 'PARTY_ID', 'PARTY_NAME'),
            ],
            [
                'attribute' => 'REGION_C',
                'value' => 'rEGION.REGION_M',
                'filter'=>ArrayHelper::map(Tblregion::find()->asArray()->all(), 'REGION_C', 'REGION_M'),
            ],
            [
                'attribute' => 'PROVINCE_C',
                'value' => 'pROVINCE.LGU_M',
                'filter'=>ArrayHelper::map(Tblprovince::find()->asArray()->all(), 'PROVINCE_C', 'LGU_M'),
            ],
             [
                'attribute' => 'CITYMUN_C',
                'value' => 'cITYMUN.LGU_M',
                'filter'=>ArrayHelper::map(Tblcitymun::find()->asArray()->all(), 'CITYMUN_C', 'LGU_M'),
            ],
            // 'DATECREATED',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<?php

echo Highcharts::widget([
    // 'contentOptions'=>[
        // 'chart'=>
        // [
        //     'type'=>'bar'
        // ],
        'options' => [
            'chart'=>[
            'type'=>'bar'
            ],
          'title' => ['text' => 'Statistics of Govenors and Mayors (by Age)'],
          'xAxis' => [
             'categories' => ['Below 30', 'Between 30 to 50', 'Above 50']
          ],
          'yAxis' => [
             'title' => ['text' => 'Fruit eaten']
          ],
          'series' => [
             ['name' => 'Governors', 'data' => [1, 3, 4]],
             ['name' => 'City Mayors', 'data' => [5, 7, 3]],
             ['name' => 'Municipal Mayors', 'data' => [5, 7, 3]]
          ]


       ]

    // ],

   
]);
?>

<?php
print_r($countOfficials);
?>
