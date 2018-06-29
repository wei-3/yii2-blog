<?php
namespace backend\models;
use yii\base\Model;

class LoginFrom extends Model{
    public $username;
    public $password;
    public $code;
    public $remember;


    public function rules()
    {
        return [
          [['username','password'],'required'],
            ['code','captcha'],
            ['remember','integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password'=>'密码',
            'code'=>'验证码',
            'remember'=>'记住我',
        ];
    }

    //登录
    public function login(){
        $user=User::findOne(['username'=>$this->username]);
        if ($user){
            //用户存在
            //密码加密
//            \Yii::$app->security->generatePasswordHash();
            //验证密码
//            \Yii::$app->security->validatePassword($this->password,$user->password_hash);
            if (\Yii::$app->security->validatePassword($this->password,$user->password_hash)){
                //获取最后登录的ip
                $user->last_login_ip=\Yii::$app->request->userIP;
                //获取最后登录时间
                $user->last_login_time=time();
                $user->save(false);
                if ($this->remember){
                    //密码正确登录
                    return \Yii::$app->user->login($user,7*24*3600);
                }
                return \Yii::$app->user->login($user);
            }else{
                $this->addError('password','密码错误');
            }
        }else{
            $this->addError('username','密码错误');
        }
        return false;
    }

}