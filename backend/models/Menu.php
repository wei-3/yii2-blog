<?php

namespace backend\models;

use Yii;

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
}
