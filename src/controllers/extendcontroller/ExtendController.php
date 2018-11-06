<?php
namespace myzero1\z1user\controllers\extendcontroller;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Base site controller
 */
class ExtendController extends Controller
{
    /**
     * Renders the main msg of notice
     * @return string
     */
    public function actionExtend1()
    {
        var_dump('z1user actionExtend1');exit;
        return $this->render('placeholder', ['position' => $position]);
    }
}
