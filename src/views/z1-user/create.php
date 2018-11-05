<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Z1User */

$this->title = Yii::t('yii', 'Create') . ' ' . 'Z1 User';
$this->params['breadcrumbs'][] = ['label' => 'Z1 Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="z1-user-create">

    <?php if(!\Yii::$app->request->isAjax): ?>
    
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>