<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu".
 *
 * @property string $id ID
 * @property string $name 名称
 * @property int $parent_id 上级菜单
 * @property string $url 地址/路由
 * @property int $sort 排序
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'parent_id'], 'required'],
            [['parent_id', 'sort'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'parent_id' => '上级菜单',
            'url' => '地址/路由',
            'sort' => '排序',
        ];
    }

    //查询上级菜单分类
    public static function getParents(){
        $parents_all=self::find()->where(['=','parent_id',0])->asArray()->all();//把对象变成数组
//        var_dump($parents_all);exit();
        $parents=ArrayHelper::map($parents_all,'id','name');
        return ArrayHelper::merge([0=>'顶级分类'],$parents);
    }
  //设置权限循环遍历在视图显示
    public static function getPermissionItems(){
        $permissions=Yii::$app->authManager->getPermissions();
        $items=ArrayHelper::map($permissions,'name','description');
        return $items;
    }
}
