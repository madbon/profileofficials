<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TblofficialsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblofficials-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'OFFICIAL_ID') ?>

    <?= $form->field($model, 'FIRSTNAME') ?>

    <?= $form->field($model, 'MIDDLENAME') ?>

    <?= $form->field($model, 'LASTNAME') ?>

    <?= $form->field($model, 'BIRTHDATE') ?>

    <?php // echo $form->field($model, 'AGE') ?>

    <?php // echo $form->field($model, 'LEVELPLACE_ID') ?>

    <?php // echo $form->field($model, 'LEVELPOSIT_ID') ?>

    <?php // echo $form->field($model, 'POSIT_ID') ?>

    <?php // echo $form->field($model, 'PARTY_ID') ?>

    <?php // echo $form->field($model, 'REGION_C') ?>

    <?php // echo $form->field($model, 'PROVINCE_C') ?>

    <?php // echo $form->field($model, 'CITYMUN_C') ?>

    <?php // echo $form->field($model, 'DATECREATED') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
