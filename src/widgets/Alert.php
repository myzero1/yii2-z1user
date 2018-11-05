<?php

namespace myzero1\layui\widgets;

/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * - \Yii::$app->getSession()->setFlash('error', 'This is the message');
 * - \Yii::$app->getSession()->setFlash('success', 'This is the message');
 * - \Yii::$app->getSession()->setFlash('info', 'This is the message');
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcerative.ru>
 */
class Alert extends \yii\bootstrap\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $alertTypes = [
        // 'error' => 'danger',//2
        // 'danger' => 'danger',//5
        // 'success' => 'success',//1
        // 'info' => 'info',//6
        // 'warning' => 'warning'//0
        'error' => 2,
        'danger' => 5,
        'success' => 1,
        'info' => 6,
        'warning' => 0,
    ];

    /**
     * @var array the options for rendering the close button tag.
     */
    public $closeButton = [];

    public function init()
    {
        parent::init();

        $session = \Yii::$app->getSession();
        $flashes = $session->getAllFlashes();
        $appendCss = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        $alertStr = 'alertfunction';
        foreach ($flashes as $type => $message) {
            $cionNum = $this->alertTypes[$type];

            $alertOpt = "
                {
                    time: 5000, //5s后自动关闭
                    btn: ['知道了'],
                    icon: $cionNum,
                    title: '提示信息'
                }
            ";

            $alert = "layer.msg('$message', $alertOpt, function(){alertfunction});";
            $alertStr = str_replace('alertfunction', $alert, $alertStr);
            $session->removeFlash($type);
        }

        $alertStr = str_replace('alertfunction', '', $alertStr);
        if ($alertStr) {
            $js = "
                layui.config({
                    base : 'js/'
                }).use(['layer','jquery'],function(){
                    var layer = layui.layer;

                    $alertStr
                });
            ";
            \Yii::$app->view->registerJs($js);
        }
    }
}