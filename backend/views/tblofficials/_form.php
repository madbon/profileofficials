<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Tbllevelbyposition;
use backend\models\Tblpositions;
use backend\models\Tblregion;
use backend\models\Tblprovince;
use yii\helpers\ArrayHelper;



/* @var $this yii\web\View */
/* @var $model backend\models\Tblofficials */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblofficials-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FIRSTNAME')->textInput() ?>

    <?= $form->field($model, 'MIDDLENAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LASTNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BIRTHDATE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AGE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LEVELPLACE_ID')->dropDownList($levelbyplace) ?>

    <?= $form->field($model, 'LEVELPOSIT_ID')->dropDownList(
                            ArrayHelper::map( Tbllevelbyposition::find()->all(), 'LEVELPOSIT_ID','LEVELPOSIT_NAME'),
                            [
                                'prompt'=>'Select level by position',
                                'onchange'=>'
                                    $.post("index.php?r=tblpositions/lists&id='.'"+$(this).val(), function(data) {
                                        $("#tblofficials-posit_id").html(data);
                                    });'
                            ]);?>

    <?= $form->field($model, 'POSIT_ID')->dropDownList(
                            ArrayHelper::map( Tblpositions::find()->all(), 'POSIT_ID','POSIT_NAME'),
                            [
                                'prompt'=>'Select  Position Title',
                                
                                
                            ]);?>

    <?= $form->field($model, 'PARTY_ID')->dropDownList($party,
        [
            'prompt'=>'Select Party Affiliation',
            ]); ?>

    <?= $form->field($model, 'REGION_C')->dropDownList(
                            ArrayHelper::map( Tblregion::find()->all(), 'REGION_C','REGION_M'),
                            [
                                'prompt'=>'Select Region',
                                'onchange'=>'
                                    $.post("index.php?r=tblprovince/lists&id='.'"+$(this).val(), function(data) {
                                        $("#tblofficials-province_c").html(data);
                                    });'
                            ]);?>

    <?= $form->field($model, 'PROVINCE_C')->dropDownList(
                            ArrayHelper::map( Tblprovince::find()->all(), 'PROVINCE_C','LGU_M'),
                            [
                                'prompt'=>'Select  Province',

                            ]);?>

    <?= $form->field($model, 'CITYMUN_C')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>