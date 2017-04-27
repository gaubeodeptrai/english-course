<?php

namespace app\controllers;

class SuccessController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
