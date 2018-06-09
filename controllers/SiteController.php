<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_DEBUG ? 'test' : null,
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['email_from'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays imprint page.
     *
     * @return string
     */
	public function actionImprint()
	{
		return $this->render('imprint');
    }
    
    /**
     * Displays error page. (for testing)
     *
     * @return string
     */
	public function actionError()
	{
		return $this->render('error');
	}

    /**
     * Displays privacy page.
     *
     * @return string
     */
	public function actionPrivacy()
	{
		return $this->render('privacy');
    }
    
    /**
     * Displays faq page.
     *
     * @return string
     */
    public function actionFaq()
    {
        return $this->render('faq');
    }
}
