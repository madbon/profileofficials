<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Tblofficials */

$this->title = 'Create Tblofficials';
$this->params['breadcrumbs'][] = ['label' => 'Tblofficials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblofficials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'levelbyplace' => $levelbyplace,
        'levelbyposition' => $levelbyposition,
        'party' => $party,
    ]) ?>

</div>
