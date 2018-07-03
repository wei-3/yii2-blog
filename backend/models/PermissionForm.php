<?php
namespace backend\models;
use yii\base\Model;

class PermissionForm extends Model{
    public $name;
    public $description;//权限描述

    public function rules()
    {
        return [
            [['name','description'],'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'=>'权限名称',
            'description'=>'权限'
        ];
    }
}