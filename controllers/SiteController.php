<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @return Response
     */
    public function actionIndex()
    {
        return $this->redirect(['site/page', 'slug' => 'slug-page-1']);
    }

    /**
     * @param $slug
     * @return string
     */
    public function actionPage($slug)
    {
        return $this->render('page', compact('slug'));
    }
}
