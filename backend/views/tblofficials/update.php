<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tblofficials */

$this->title = 'Update Tblofficials: ' . $model->OFFICIAL_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tblofficials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->OFFICIAL_ID, 'url' => ['view', 'id' => $model->OFFICIAL_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tblofficials-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'party' => $party,
        'queryposition'=>$queryposition,
        'arrlevelbyposition' => $arrlevelbyposition,
        'querylevelbyposition' => $querylevelbyposition,
        'queryregion' => $queryregion,
        'queryprovince' => $queryprovince,
        'querycitymun' => $querycitymun,
    ]) ?>

</div>
