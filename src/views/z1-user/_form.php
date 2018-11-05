<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

myzero1\layui\assets\php\components\plugins\LayFormAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\Z1User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="z1-user-form">

    <?php    $form = ActiveForm::begin([
        'id'=> 'layer-form-' . $this->context->action->id,
        'options' => [
            'class' => 'z1-layui-form adminlteiframe-form layui-form layui-form-pane layui-form-hr'
        ],
        'fieldConfig' => [
            'options' => ['class' => 'layui-form-item form-group'],
            'template' => "{label}\n<div class='layui-input-block'>{input}</div>\n{hint}",
            'labelOptions' => [
                'class' => 'layui-form-label',
            ],
            'inputOptions' => [
                'class' => 'layui-input',
            ],
            'hintOptions' => [
                'class' => 'hint-block',
            ],
        ]
    ]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group  layui-right form-acitons">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'layui-btn' : 'layui-btn layui-btn-normal']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
