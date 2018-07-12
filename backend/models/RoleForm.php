<?php
namespace backend\models;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class RoleForm extends Model{
    public $name;
    public $description;
    public $permissions;

    public function rules()
    {
        return [
            [['name','description'],'required'],
            ['permissions','safe'],
            ['name','validateName']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'=>'角色名称',
            'description'=>'角色描述'
        ];
    }

    //查询权限  返回视图role 的列表中
    public static function getPermissionItems(){
        //获取所有权限
        $permissions=\Yii::$app->authManager->getPermissions();
        //方法一：
//        $items=[];
//        foreach ($permissions as $permission){
//            $items[$permission->name]=$permission->description;
//        }
        //方法二：
        $items=ArrayHelper::map($permissions,'name','description');
        return $items;
    }

    public function validateName(){
        if(\Yii::$app->authManager->getRole($this->name)){
            $this->addError('name','权限已存在');
        }
    }


}