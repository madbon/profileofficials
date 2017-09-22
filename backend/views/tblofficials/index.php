<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
            // 'LEVELPLACE_ID',
            // 'LEVELPOSIT_ID',
            // 'POSIT_ID',
            // 'PARTY_ID',
            // 'REGION_C',
            // 'PROVINCE_C',
            // 'CITYMUN_C',
            // 'DATECREATED',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
