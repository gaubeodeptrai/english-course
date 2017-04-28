<?php

namespace app\controllers;

use app\models\GadgetsFilterForm;
use app\modules\courses\models\Category;
use Yii;
use app\modules\courses\api\Catalog;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\easyii\modules\shopcart\models\Good;
use yii\easyii\modules\shopcart\models\Order;

class CourseController extends \yii\web\Controller
{
    public $successUrl = '';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','plan','error','index','cat','free','search'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'add','remove','view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
                'successUrl' => $this->successUrl
            ],
        ];
    }

    public function actionIndex()
    {
        $courses = Category::find()->where(['type'=>'premium'])->all();
        $free_courses = Category::find()->where(['type'=>'free'])->all();
        return $this->render('index',[
            'courses' => $courses,
            'free_courses' => $free_courses
        ]);
    }
    
    public function actionFree(){
        $courses = Category::find()->where(['type'=>'free'])->all();
        $premium_courses = Category::find()->where(['type'=>'premium'])->all();
        return $this->render('free',[
            'courses' => $courses,
            'premium_courses' => $premium_courses
        ]);
    }

    public function actionCat($slug)
    {
        $filterForm = new GadgetsFilterForm();
        $cat = Catalog::cat($slug);
        //echo $cat->model->category_id;
        //exit();   
        if(!$cat){
            throw new NotFoundHttpException('Shop category not found.');
        }
        $courses = Category::find()->where(['status'=>1])
                                   ->andWhere(['depth'=>0])
                                   ->andWhere('category_id <>'.$cat->model->category_id) 
                                   ->limit(10)
                                   ->all();
        // Danh sach comment cho khoa hoc nay
        $comments = \app\modules\comment\models\Guestbook::find()
                ->where('status = 1')
                ->andWhere(['course_id'=>$cat->model->category_id])
                ->all();
        // Dem tong so hoc vien da thanh toan
        $count_person = Good::find()->where(['item_id'=>$cat->model->category_id])->joinWith([
            'order'=> function($query){
                $query->andWhere('status = 7');
            },
        ])->count();
        // Kiem tra hoc vien da thanh toan chua
        if (Yii::$app->user->id):    
        $paid = Good::find()->where(['item_id'=>$cat->model->category_id])->joinWith([
            'order'=> function($query){
                $query->andWhere('status = 7');
            },
        ])->count();    
        else:
        $paid = 0;    
        endif;    
            
        $filters = null;
        if($filterForm->load(Yii::$app->request->get()) && $filterForm->validate()) {
            $filters = $filterForm->parse();
        }

        return $this->render('cat', [
            'cat' => $cat,
            'courses' => $courses,
            'comments' => $comments,
            'count_person' => $count_person,
            'paid' => $paid,
            'items' => $cat->items([
                'pagination' => ['pageSize' => 10],
                'filters' => $filters
            ]),
            
            'filterForm' => $filterForm
        ]);
    }

    public function actionSearch($text)
    {
        $text = filter_var($text, FILTER_SANITIZE_STRING);

        return $this->render('search', [
            'text' => $text,
            'items' => Category::find()->where(['like', 'title', $text])->orWhere(['like', 'description', $text])->all()
            
        ]);
    }

    public function actionView($slug)
    {

         $item = Catalog::get($slug);
         $category_id = $item->model->category_id;
         $course = Catalog::cat($category_id)->model->tree;
         $type = Catalog::cat($course)->model->type;
         //echo $type;
        //exit();
        
        if ($type == 'premium'){
        $paid = Good::find()->where(['item_id'=>$course])->joinWith([
            'order'=> function($query){
                $query->andWhere(['status' => 7]);
            },
        ])->count();
        }    
        else
        if($type == 'free'){    
            
           $paid = 'free'; 
        }   
        
         
        if(!$item){
            throw new NotFoundHttpException('Item not found.');
        }

        return $this->render('view', [
            'item' => $item,
            'addToCartForm' => new \app\models\AddToCartForm(),
            'paid' =>$paid,
            'type' =>$type,
           
        ]);
    }
}
