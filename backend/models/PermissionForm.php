<?php
namespace backend\models;
use yii\base\Model;

class PermissionForm extends Model{
    public $name;
    public $description;//权限描述

    public function rules()
    {
        return [
            [['name','description'],'required'],
//            ['name','unique']用它不行，是活动记录用的
            ['name','validateName']
        ];
    }

    public function validateName(){
        if(\Yii::$app->authManager->getPermission($this->name)){
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