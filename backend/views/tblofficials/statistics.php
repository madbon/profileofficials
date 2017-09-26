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
use yii\helpers\BaseStringHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TblofficialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Statistics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblofficials-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php

$below30Gov = $queryCountGovernor;
$below30CityMay = $queryCountCityMayor;
$below30MunMay = $queryCountMunMayor;

$betGov = $govResultFloatBet;
$betCityMay = $citymayorResultFloatBet;
$betMunMay = $munmayorResultFloatBet;

$aboveGov = $govResultFloatAbove;
$aboveCityMay = $citymayorResultFloatAbove;
$aboveMunMay = $munmayorResultFloatAbove;



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
          'title' => ['text' => 'Statistics of Govenors and Mayors by Age'],
          'xAxis' => [
             'categories' => ['Below 30', 'Between 30 to 50', 'Above 50']
          ],
          'yAxis' => [
             'title' => ['text' => 'Fruit eaten']
          ],
          'series' => [
             ['name' => 'Governors', 'data' => [$below30Gov , $betGov, $aboveGov]],
             ['name' => 'City Mayors', 'data' => [$below30CityMay, $betCityMay, $aboveCityMay]],
             ['name' => 'Municipal Mayors', 'data' => [$below30MunMay, $betMunMay, $aboveMunMay]]
          ]


       ]

    // ],

   
]);
?>
 <!-- http://www.yiiframework.com/forum/index.php/topic/54011-dynamic-data-of-column-with-drilldown-yii-highcharts -->
<?php
// $level1 = array();
// $level1[] = array('name' => 'Firefox', 'y' =>12,);
// $level1[] = array('name' => 'Internet Explorer', 'y' =>5);
// $level1[] = array('name' => 'Safari', 'y' =>4);
// $level1[] = array('name' => 'Chrome', 'y' =>8);
// $level1[] = array('name' => 'Opera', 'y' =>9);

echo Highcharts::widget([
    // 'contentOptions'=>[
        // 'chart'=>
        // [
        //     'type'=>'bar'
        // ],
        'options' => [
            'chart'=>[
            'plotBackgroundColor'=> null,
            'plotBorderWidth'=> null,
            'plotShadow'=> false,
            'type'=> 'pie'
            ],

            'tooltip' =>[
                 'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>'
            ],
            'plotOptions' => [ // plotoption-start
                'pie' => [
                    'allowPointSelect'=> true,
                    'cursor'=> 'pointer',
                    'dataLabels' => [
                        'enabled'=> true,
                        'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
                        'style' =>[
                            'color'=>  'black'
                        ]
                    ]
                ]
            ], // plotoption-end
          'title' => ['text' => 'Statistics of Mayors by Party Affiliation'],
          
         
          'series' => [
            [ // {
                'type' => 'pie',
                'name' => 'Elements',
                'data' => $datapie,

                    // ['name' => 'Firefox', 'y' => 20],
                    // ['name' => 'IE', 'y' => 26.8],
                    // ['name' => 'Safari', 'y' => 8.5],
                    // ['name' => 'Opera', 'y' =>  6.2],
                    // ['name' => 'Others', 'y' => 0.7]
                  
                
            ] // }


       ]]

    // ],

   
]);
?>



<?php

// print_r($dataPie);


?>
