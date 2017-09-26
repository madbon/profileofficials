<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Tbllevelbyposition;
use backend\models\Tblpositions;
use backend\models\Tblregion;
use backend\models\Tblprovince;
use backend\models\tblcitymun;
use yii\helpers\ArrayHelper;
// use kartik\date\DatePicker;
use dosamigos\datepicker\DatePicker;



/* @var $this yii\web\View */
/* @var $model backend\models\Tblofficials */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblofficials-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FIRSTNAME')->textInput() ?>

    <?= $form->field($model, 'MIDDLENAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LASTNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BIRTHDATE')->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => false, 
         // modify template for custom rendering
        // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d'
        ]
]);?>  

    <?= $form->field($model, 'LEVELPOSIT_ID')->dropDownList(
                            ArrayHelper::map($querylevelbyposition, 'LEVELPOSIT_ID','LEVELPOSIT_NAME'),
                            [
                                'prompt'=>'Select level by position',
                                'onchange'=>'
                                    $.post("index.php?r=tblpositions/lists&id='.'"+$(this).val(), function(data) {
                                        $("#tblofficials-posit_id").html(data);
                                    });'
                            ]);?>

    <?= $form->field($model, 'POSIT_ID')->dropDownList(
                            ArrayHelper::map( $queryposition, 'POSIT_ID','POSIT_NAME'),
                            [
                                'prompt'=>'Select  Position Title',
                                
                            ]);?>

    <?= $form->field($model, 'PARTY_ID')->dropDownList($party,
        [
            'prompt'=>'Select Party Affiliation',
            ]); ?>

    <?= $form->field($model, 'REGION_C')->dropDownList(
                            ArrayHelper::map( $queryregion, 'REGION_C','REGION_M'),
                            [
                                'prompt'=>'Select Region',
                                'onchange'=>'
                                    $.post("index.php?r=tblprovince/lists&id='.'"+$(this).val(), function(data) {
                                        $("#tblofficials-province_c").html(data);
                                    });
                                  
                                    '
                            ]);?>
    <?=
        $this->registerJs(' $("#tblofficials-region_c").change(function(){
                    var valuereg = $("#tblofficials-region_c").val();
                    var valueprov =  $("#tblofficials-province_c").val()
                    $.post(
                    "'.Yii::$app->urlManager->createUrl(["tblcitymun/getcitymun"]).'",
                     { valuereg:valuereg,
                       valueprov:valueprov },
                     function(data) {
                       $( "#tblofficials-citymun_c").html(data);
                    }); });');
        ?>

    <?= $form->field($model, 'PROVINCE_C')->dropDownList(
                            ArrayHelper::map( $queryprovince, 'PROVINCE_C','LGU_M'),
                            [
                                'prompt'=>'Select  Province',
                               
                            ]);?>

 <?=
        $this->registerJs(' $("#tblofficials-province_c").change(function(){
                    var valuereg = $("#tblofficials-region_c").val();
                    var valueprov =  $("#tblofficials-province_c").val()
                    $.post(
                    "'.Yii::$app->urlManager->createUrl(["tblcitymun/getcitymun"]).'",
                     { valuereg:valuereg,
                       valueprov:valueprov },
                     function(data) {
                       $( "#tblofficials-citymun_c").html(data);
                    }); });');
        ?>

    <?= $form->field($model, 'CITYMUN_C')->dropDownList( ArrayHelper::map( $querycitymun, 'CITYMUN_C','LGU_M')
                            );?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
