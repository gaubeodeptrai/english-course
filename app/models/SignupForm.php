<?php
namespace app\models;

use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $fullname;
    public $tel;
    public $subject;
    public $body;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['fullname', 'string'],
            ['fullname', 'required','message'=>'Bạn chưa điền {attribute}'],
            
            ['tel', 'string'],
            
            ['username', 'trim'],
            ['username', 'required','message'=>'Bạn chưa điền {attribute}'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Đã có người đăng ký bằng Username này trước đó.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required','message'=>'Bạn chưa điền {attribute}'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Đã có người đăng ký bằng email này trước đó.'],

            ['password', 'required','message'=>'Bạn chưa điền {attribute}'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->fullname = $this->fullname;
        $user->tel = $this->tel;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->level = 2;
        $user->chapnhan = 0;
        return $user->save() ? $user : null;
    }
    public function attributeLabels(){
            return [
                'fullname'=>'Họ tên',
                'tel'=>'Điện thoại',
                'username'=>'Username',
                'password'=>'Password',
            ];
    }
    public function sendEmail($email)
    {
        $user_register = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);
        return \Yii::$app->mailer->compose(['html' => 'register_admin_html'],['user_register'=>$user_register])
            ->setTo($email)
            ->setFrom([$this->email => \Yii::$app->params['supportEmail']])
            ->setSubject('Có người đăng ký tài khoản : '.$this->fullname.' ')
            //->setTextBody()
            ->send();
    }
}
