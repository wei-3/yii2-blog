<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "article".
 *
 * @property string $id
 * @property string $author
 * @property string $title
 * @property string $created_time
 * @property integer $updated_time
 * @property string $click
 * @property integer $article_category_id
 * @property string $picture
 * @property integer $ is_show
 * @property integer $status
 * @property string $intro
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_time','article_category_id','sort', 'status'], 'integer'],
            [['intro'], 'string'],
            [ 'title', 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '文章名字',
            'created_time' => '编写时间',
            'updated_time' => '更新时间',
            'click' => '点击率',
            'article_category_id' => '分类标题',
            'picture' => '图片',
            'status' => '状态',
            'intro' => '简介',
        ];
    }
//添加时间行为
    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'createdAtAttribute' => 'created_time',// 自己根据数据库字段修改
                'updatedAtAttribute' => 'updated_time', // 自己根据数据库字段修改,
                'value'   =>function(){
                        return time();
                }
                //'value'   => new Expression('NOW()'),
            ]
        ];
    }

    public function getCategroy(){
        //参数1 要关联的对象 参数2 关联的主键（要关联对象的主键，当前对象的关联主键）
        return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);
    }
}
