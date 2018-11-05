<?php

namespace myzero1\z1user\controllers;

use Yii;
use myzero1\layui\models\Z1User;
use myzero1\layui\models\search\Z1UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * Z1UserController implements the CRUD actions for Z1User model.
 */
class Z1UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'delete-selected' => ['post'],
                ],
            ],
        ];
    }

    public function render($view, $params = [])
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax($view, $params);
        } else {
            return parent::render($view, $params);
        }
    }


    /**
     * Renders the index view for the module，render the layout
     * @return string
     */
    public function actionInit()
    {
        if (\Yii::$app->request->isPost) {
            $iniSql = '
                CREATE TABLE IF NOT EXISTS `z1_user` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
                  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  `status` smallint(6) NOT NULL DEFAULT 10,
                  `created_at` int(11) NOT NULL,
                  `updated_at` int(11) NOT NULL,
                  PRIMARY KEY (`id`),
                  UNIQUE KEY `username` (`username`),
                  UNIQUE KEY `email` (`email`),
                  UNIQUE KEY `password_reset_token` (`password_reset_token`)
                ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
            ';
            $result = \Yii::$app->db->createCommand($iniSql)->execute();

            \Yii::$app->getSession()->setFlash('success', '恭喜你，初始化操作成功。');
        }

        return $this->render('init');
    }

    /**
     * Lists all Z1User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Z1UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $pageSize = intval(trim(Yii::$app->request->get('per-page')));

        if ($pageSize) {
            $dataProvider->pagination->pageSize = $pageSize;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Z1User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Z1User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Z1User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', '添加成功');
            return \myzero1\layui\helpers\Tool::redirectParent(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Z1User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', '修改成功');
            return \myzero1\layui\helpers\Tool::redirectParent(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Z1User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->getSession()->setFlash('success', '删除成功');
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Z1User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteSelected($z1selected)
    {
        if (empty($z1selected)) {
            return 'z1selected 不能为空。';
        } else {
            Z1User::deleteAll(['id' => explode(',', $z1selected)]);

            Yii::$app->getSession()->setFlash('success', '批量删除成功');

            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Z1User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Z1User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
                if (($model = Z1User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}