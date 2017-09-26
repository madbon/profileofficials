<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Tblofficials */

$this->title = 'Create Local Officials';
$this->params['breadcrumbs'][] = ['label' => 'Local Officials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblofficials-create">

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
