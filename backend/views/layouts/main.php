<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

<style>
    #mycontainer-fluid
    {
        padding-top: 50px;
    }
     ul.breadcrumb > :first-child 
    {
        display: none;
    } 
    ul#my_submenu
    {
        padding-top: 100px;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        padding-bottom: 20px;

    }
     ul#my_submenu li
    {
        display: inline-block;
        padding-left: 70px; 
    }
     ul#my_submenu li.first
    {
        display: inline-block;
        padding-left: 0; 
        margin-left: 0;
    }
    ul#my_submenu li a
    {
        background-color: black;
        padding-right:10px;
        padding-left: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: 20px;
    }
</style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Newly Elected Officials',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <ul id="my_submenu">
        <li class="first"><a href="<?= Url::to('index.php?r=tblofficials%2Findex')?>"><i class="glyphicon glyphicon-list-alt"></i> Master List of Local Officials</li>
        <li><a href="<?= Url::to('index.php?r=tblofficials%2Fstatistics')?>"><i class="fa fa-bar-chart-o fa-fw"></i> Statistics</a></li>
    </ul>

    <!-- <div class="container-fluid" id="mycontainer-fluid"> -->
       <!-- 
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?= Url::to('index.php?r=tblofficials%2Findex')?>"><i class="glyphicon glyphicon-list-alt"></i> Master List of Local Officials</a>
                        </li>
                        <li>
                            <a href="<?= Url::to('index.php?r=tblofficials%2Fstatistics')?>"><i class="fa fa-bar-chart-o fa-fw"></i> Statistics</a>
                           
                        </li>
                    </ul>
                </div>               
            </div> -->
            

        <!-- Page Content -->
        <!-- <div id="page-wrapper"> -->
            <div class="container-fluid">
                <!-- <div class="row"> -->
                    <!-- <div class="col-lg-12"> -->
                        
                         <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]) ?>
                            <?= Alert::widget() ?>
                         <?= $content ?>
                    <!-- </div> -->
                    <!-- /.col-lg-12 -->
                <!-- </div> -->
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        <!-- </div> -->
        <!-- /#page-wrapper -->
    <!-- </div> -->
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Newly Elected Officials <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

<script type="text/javascript">
    $(document).ready(function(){
        $("div.container").removeClass('container').addClass('container-fluid');
    });
</script>
</body>
</html>
<?php $this->endPage() ?>
