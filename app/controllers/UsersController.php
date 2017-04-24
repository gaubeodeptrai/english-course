<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * HocsinhController implements the CRUD actions for Hocsinh model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','index'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => TRUE,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Hocsinh models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else
        if (\common\models\User::findLevel(\Yii::$app->user->id) > 0)    
            {
            Yii::$app->session->setFlash('error', 'Xin lỗi, bạn đang truy cập trái phép vào khu vực của người quản trị.');
            return $this->goHome(); 
        }
        else{
        
        return $this->render('index');
        }
    }

    /**
     * Displays a single Hocsinh model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
         if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else
        if (\common\models\User::findLevel(\Yii::$app->user->id) > 0)    
            {
            Yii::$app->session->setFlash('error', 'Xin lỗi, bạn đang truy cập trái phép vào khu vực của người quản trị.');
            return $this->goHome(); 
        }
        else{
        return $this->render('view', [
            'model' => User::findOne(['id'=>$id]),
        ]);
        } 
    }

    /**
     * Creates a new Hocsinh model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else
        if (\common\models\User::findLevel(\Yii::$app->user->id) > 0)    
            {
            Yii::$app->session->setFlash('error', 'Xin lỗi, bạn đang truy cập trái phép vào khu vực của người quản trị.');
            return $this->goHome(); 
        }
        else{
        $model = new Hocsinh();
           
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
      }
    }

    /**
     * Updates an existing Hocsinh model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    
    public function actionActive($id)
    { 
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else
        if (\common\models\User::findLevel(\Yii::$app->user->id) > 0)    
            {
            Yii::$app->session->setFlash('error', 'Xin lỗi, bạn đang truy cập trái phép vào khu vực của người quản trị.');
            return $this->goHome(); 
        }
        else{
            
        $model = User::findOne($id);

         User::updateAll(['chapnhan' => 1], ['in', 'id', $id]);
         Yii::$app->mailer->compose(['html' => 'register_success_html'],['user_register'=>$model])
            ->setTo($model->email)
            ->setFrom('admin@tieuhocnghiatan.vn')
            ->setSubject('Danh bạ học sinh trường tiểu học Nghĩa Tân ')
            //->setTextBody()
            ->send();
         Yii::$app->session->setFlash('success', 'Tài khoản này đã được kích hoạt thành công.');
        return $this->redirect(['view', 'id' => $model->id]);
      }  
    }
    
    public function actionUpdate($id)
    { 
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else
        if (\common\models\User::findLevel(\Yii::$app->user->id) > 0)    
            {
            Yii::$app->session->setFlash('error', 'Xin lỗi, bạn đang truy cập trái phép vào khu vực của người quản trị.');
            return $this->goHome(); 
        }
        else{
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
      }  
    }

    /**
     * Deletes an existing Hocsinh model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else
        if (\common\models\User::findLevel(\Yii::$app->user->id) > 0)    
            {
            Yii::$app->session->setFlash('error', 'Xin lỗi, bạn đang truy cập trái phép vào khu vực của người quản trị.');
            return $this->goHome(); 
        }
        else{
            User::findOne($id)->delete();
            Yii::$app->session->setFlash('sussess', 'Đã xóa bỏ thành công'); 
            return $this->redirect(['index']);
      }  
    }

    /**
     * Finds the Hocsinh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hocsinh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hocsinh::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
