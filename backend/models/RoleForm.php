<?php
namespace backend\models;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class RoleForm extends Model{
    public $name;
    public $description;
    public $permissions;
    const SCENARIO_EDITROLE ='edit-role';
    const SCENARIO_ADDROLE ='add-role';

    public function rules()
    {
        return [
            [['name','description'],'required'],
            ['permissions','safe'],
            ['name','validateName','on'=>self::SCENARIO_ADDROLE],
            ['name','validateEditName','on'=>self::SCENARIO_EDITROLE]
        ];
    }
     //必须定义场景
    //第一种是规则里用on
    //第二种定义方法(如果定义的场景在rule中没有配置，需要通过scenarios方法声明，否则会提示场景不存在)
//    public function scenarios()
//    {
//        return [
//            self::SCENARIO_EDITROLE=>[],//指定该场景下需要验证哪些字段（空数组表示所有字段）
//        ];
//    }

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
        $auth=\Yii::$app->authManager;
        if($auth->getRole($this->name)){
                $this->addError('name','该角色已存在');
        }
    }

    public function validateEditName(){
        $auth=\Yii::$app->authManager;
        //情况：一 没有修改名称(不管) 二 修改了名称，新名称不能存在
        //怎么判断名称修改没有 通过get参数获取旧名称
        if(\Yii::$app->request->get('name')!=$this->name){
            if($auth->getRole($this->name)){
                $this->addError('name','该角色已存在');
            }
        }
    }

}