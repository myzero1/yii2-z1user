<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Z1User */

$this->title = Yii::t('yii', 'Update') . ' ' . 'Z1 User' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Z1 Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>

<div class="z1-user-update">

    <?php if(!\Yii::$app->request->isAjax): ?>
    
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>