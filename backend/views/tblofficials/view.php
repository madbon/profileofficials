<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tblofficials */

$this->title = $model->OFFICIAL_ID;
$this->params['breadcrumbs'][] = ['label' => 'Local Officials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblofficials-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->OFFICIAL_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->OFFICIAL_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'lEVELPOSIT.LEVELPOSIT_NAME',
            'pOSIT.POSIT_NAME',
            'pARTY.PARTY_NAME',
            'rEGION.REGION_M',
            'pROVINCE.LGU_M',
            'cITYMUN.LGU_M',
            'DATECREATED',
        ],
    ]) ?>

</div>
