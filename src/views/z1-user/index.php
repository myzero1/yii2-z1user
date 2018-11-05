<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\Z1UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

myzero1\layui\assets\php\components\plugins\LayTableAsset::register($this);

$this->title = 'Z1 Users';
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    'checkbox_column' => [
        'headerOptions' => [
            'lay-data'=>"{type:'checkbox',fixed:'left',width:50}",
        ],
        'attribute' => 'id',
    ],
    /*'scerial_column' => [
        'headerOptions' => [
            'lay-data'=>"{field:'SerialColumn'}"
        ],
        'class' => 'yii\grid\SerialColumn',
    ],*/
        'id' => [
        'headerOptions' => [
            'lay-data'=>"{field:'id',sort:true}"
        ],
        'attribute' => 'id',
    ],
    'username' => [
        'headerOptions' => [
            'lay-data'=>"{field:'username',sort:true}"
        ],
        'attribute' => 'username',
    ],
    'auth_key' => [
        'headerOptions' => [
            'lay-data'=>"{field:'auth_key',sort:true}"
        ],
        'attribute' => 'auth_key',
    ],
    'password_hash' => [
        'headerOptions' => [
            'lay-data'=>"{field:'password_hash',sort:true}"
        ],
        'attribute' => 'password_hash',
    ],
    'password_reset_token' => [
        'headerOptions' => [
            'lay-data'=>"{field:'password_reset_token',sort:true}"
        ],
        'attribute' => 'password_reset_token',
    ],
/*    'email' => [
        'headerOptions' => [
            'lay-data'=>"{field:'email', sort: true}"
        ],
        'attribute' => 'email',
    ],*/
/*    'status' => [
        'headerOptions' => [
            'lay-data'=>"{field:'status', sort: true}"
        ],
        'attribute' => 'status',
    ],*/
/*    'created_at' => [
        'headerOptions' => [
            'lay-data'=>"{field:'created_at', sort: true}"
        ],
        'attribute' => 'created_at',
    ],*/
/*    'updated_at' => [
        'headerOptions' => [
            'lay-data'=>"{field:'updated_at', sort: true}"
        ],
        'attribute' => 'updated_at',
    ],*/
    [
        'headerOptions' => [
            'lay-data'=>"{field:'operation','unresize':true,fixed:'right',width:200}"
        ],
        'header' => '操作',
        'class' => 'yii\grid\ActionColumn',
        'template' => '{update}{delete}{view}',
        'buttons' => [
            'view' => function ($url, $model, $key) {
                $options = array_merge([
                    'class'=>'layui-btn layui-btn-xs layui-btn-primary use-layer',
                    'layer-config' => sprintf('{type:2,title:"%s",content:"%s",shadeClose:false,area:["100%%","100%%"],backtip:"点击此处返回文章列表"}', Yii::t('yii', 'View'), $url) ,
                ]);
                return Html::a(Yii::t('yii', 'View'), '#', $options);
            },
            'update' => function ($url, $model, $key) {
                $options = array_merge([
                    'class'=>'layui-btn layui-btn-xs use-layer',
                    'layer-config' => sprintf('{type:2,title:"%s",content:"%s",shadeClose:false,area:["100%%","100%%"],backtip:"点击此处返回文章列表"}', Yii::t('yii', 'Update'), $url) ,
                ]);
                return Html::a(Yii::t('yii', 'Update'), '#', $options);
            },
            'delete' => function ($url, $model, $key) {
                $options = array_merge([
                    'class'=>'layui-btn layui-btn-xs layui-btn-danger use-layer',
                    'layer-config' => sprintf('{icon:3,area:["auto","auto"],type:0,title:"%s",content:"%s",shadeClose:false,btn:["确定","取消"],yes:function(index,layero){$.post("%s", {}, function(str){$(layero).find(".layui-layer-content").html(str);});},btn2:function(index, layero){layer.close(index);}}', Yii::t('yii', 'Delete'), '一旦删除，不能找回，你确定删除吗？',$url) ,
                ]);
                return Html::a(Yii::t('yii', 'Delete'), '#', $options);
            }
        ],
    ],
];

$initSort = [];
if (Yii::$app->request->get('sort')) {
    $sort = Yii::$app->request->get('sort');

    $initSort['field'] = trim($sort,'-');
    if ($sort[0] === '-') {
        $initSort['type'] = 'desc';
    } else {
        $initSort['type'] = 'asc';
    }
} else if ($dataProvider->sort->defaultOrder) {

    $defaultOrder = $dataProvider->sort->defaultOrder;
    $first_val = reset($defaultOrder);
    $first_key = key($defaultOrder);

    $initSort['field'] = $first_key;
    if ($first_val === 3) {
        $initSort['type'] = 'desc';
    } else {
        $initSort['type'] = 'asc';
    }
}

$initSortStr = count($initSort) ? json_encode($initSort) : '';

if (Yii::$app->request->get('per-page')) {
    $limit = Yii::$app->request->get('per-page');
} else {
    $limit = $dataProvider->pagination->pageSize;
}

$curr = Yii::$app->request->get('page') ? Yii::$app->request->get('page') : 1;
$count = $dataProvider->getTotalCount();

?>
<div class="z1-user-index">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => $columns,
        'options' => [
            'class' => 'adminlteiframe-gridview',
        ],
        'tableOptions' => [
            'class' => 'gridview-table gridview-table-list table table-bordered table-hover dataTable layui-hide ',
            'lay-filter'=>'z1gridview-laytable',
            'id' => 'z1gridview-laytable',
            'limit' => $limit,
            'curr' => $curr,
            'initSortStr' => $initSortStr,
            'count' => $count,
            'subSelectors' => '[".layui-form-action"]',
            'subHeight' => 60,
            'laytableopts' => '{"page":true}',
        ],
        'layout'=> '{items}',
    ]); ?>

</div>
