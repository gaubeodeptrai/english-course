<?php

namespace app\controllers;

use Yii;
use yii\easyii\modules\page\models\Page;
use yii\web\Controller;

use app\models\LoginForm;
use app\models\SignupForm;

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
        ];
    }


    public function actionIndex()
    {
        $allcourses = \app\modules\courses\models\Category::find()
                ->where(['status'=>1])
                ->andWhere('depth = 0')
                ->limit(6)
                ->orderBy(['order_num'=>SORT_DESC])
                ->all();
        
        if(!Yii::$app->getModule('admin')->installed){
            return $this->redirect(['/install/step1']);
        }
        return $this->render('index',[
            'allcourses' => $allcourses
        ]);
    }
   
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
   
    
   
    
}