<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $last_login_time
 * @property string $last_login_ip
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password;
    public $confirm_password;
    //常量定义场景
    const SCENARIO_ADD ='add';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email','status'], 'required'],
            [['password','confirm_password'], 'required','on'=>self::SCENARIO_ADD],
            [['status', 'created_at', 'updated_at', 'last_login_time'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['password'], 'string'],
            [['last_login_ip'], 'string', 'max' => 11],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'password_hash' => '哈希密码',
            'password' => '密码',
            'confirm_password' => '确认密码',
            'password_reset_token' => 'Password Reset Token',
            'email' => '邮箱',
            'status' => '状态',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_login_time' => 'Last Login Time',
            'last_login_ip' => '最后登录ip',
        ];
    }


    //保存之前做的事

    public function beforeSave($insert)
    {
        //$insert ，bool 是否是添加

        if ($insert){
            //添加
            //密码加密 添加时间 auth_key
            $this->password_hash=Yii::$app->security->generatePasswordHash($this->password);
            $this->created_at=time();
            $this->updated_at=time();
            $this->auth_key=Yii::$app->security->generateRandomString();//随机字符串
        }else{
            //修改
            $this->updated_at=time();
            if ($this->password){
                $this->password_hash=Yii::$app->security->generatePasswordHash($this->password);
            }

        }


        return parent::beforeSave($insert); // 必须返回父类方法，该方法必须返回true，save（）方法才会执行

    }

    public function getMenus(){
//        在视图中layouts的main.php可以演示
        //        最原始数据(从数据库中查)
//        ['id'=>1,'name'=>'用户管理','parent_id'=>0,'sort'=>1,'url'=>''],
//        ['id'=>2,'name'=>'添加用户','parent_id=>1','sort'=>1,'url'=>'user/add'],
//        ['id'=>3,'name'=>'修改用户','parent_id=>1','sort'=>1,'url'=>'user/edit'],
//        需转换成以下
//        ['label'=>'用户管理',items=>[
//            ['label'=>'添加用户','url'=>'user/add']
//            ['label'=>'修改用户','url'=>'user/edit']
//        ]]
        $menuItems=[];
        //获取所有一级菜单
        $menus=Menu::find()->where(['parent_id'=>0])->all();
        foreach ($menus as $menu){
            //获取一级菜单的所有子菜单
            $children=Menu::find()->where(['parent_id'=>$menu->id])->all();
            $items=[];
            foreach ($children as $child){
                $items[]=['label'=>$child->name,'url'=>[$child->url]];
            }
//            $items=[
//                ['label'=>'添加用户','url'=>'user/add']
//            ];
            $menuItems[]=['label'=>$menu->name,'items'=>$items];
        }
        return $menuItems;
    }


    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    //根据id查找用户
    public static function findIdentity($id)
    {
        return self::findOne(['id'=>$id]);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    //返回用户id  对象的方法（说明已经实例化好了）所以用this
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $authKey==$this->auth_key;
    }

    /**
     * Returns static class instance, which can be used to obtain meta information.
     * @param bool $refresh whether to re-create static instance even, if it is already cached.
     * @return static class instance.
     */
    public static function instance($refresh = false)
    {
        // TODO: Implement instance() method.
    }
}
