<?php
namespace backend\models;
use yii\base\Model;

class PermissionForm extends Model{
    public $name;
    public $description;//权限描述
    const SCENARIO_ADDPERMISSION='add-permission';
    const SCENARIO_EDITPERMISSION='edit-permission';

    public function rules()
    {
        return [
            [['name','description'],'required'],
//            ['name','unique']用它不行，是活动记录用的
            ['name','validateName','on'=>self::SCENARIO_ADDPERMISSION],
            ['name','validateEditName','on'=>self::SCENARIO_EDITPERMISSION],
        ];
    }

    public function validateName(){
        if(\Yii::$app->authManager->getPermission($this->name)){
            $this->addError('name','权限已存在');
        }
    }

    public function validateEditName(){
        if(\Yii::$app->request->get('name')!=$this->name&&\Yii::$app->authManager->getPermission($this->name)){
            $this->addError('name','权限已存在');
        }
    }

    public function attributeLabels()
    {
        return [
            'name'=>'权限名称',
            'description'=>'权限描述'
        ];
    }
}