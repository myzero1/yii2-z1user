<?php
use yii\helpers\Html;

$formStr = sprintf('%s%s%s',
    Html::beginForm(['user/init'], 'post'),
    Html::submitButton(
        '点击本按钮进行初始化',
        ['class' => 'layui-btn layui-btn-normal']
    ),
    Html::endForm())

?>
<blockquote class="layui-elem-quote">
    Crud操作的初始化。进行curd操作是，需要有一个数据库表。初始化工作就创建这个表。<span class="layui-red">若未进行初始化而进入“列表页面”,将会报错。</span>
</blockquote>
<fieldset class="layui-elem-field layui-field-title magt30">
    <legend>实际操作</legend>
</fieldset>
<p>
    在初始化时，我们做的事情很简单，就是点击下面的“初始化”按钮等待返回成功就好了。具体的创建表啥的，都由程序在后台自动完成。
</p>
<br/>

<?=$formStr?>



