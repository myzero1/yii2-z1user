<?php

namespace myzero1\z1user\controllers;

use yii\web\Controller;

/**
 * Default controller for the `z1user` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
