<?php

namespace backend\models;

use backend\controllers\ArticleController;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "comment".
 *
 * @property string $id
 * @property string $username
 * @property string $createtime
 * @property string $content
 * @property integer $top
 * @property string $praise
 * @property integer $report
 * @property integer $article_id
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'required'],
            [['created_at', 'top', 'praise', 'report', 'article_id'], 'integer'],
            [['content'], 'string'],
            [['username'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'username' => '用户名',
            'created_at' => '回复时间',
            'content' => '回复内容',
            'top' => '置顶',
            'praise' => '点赞数量',
            'report' => '是否举报',
            'article_id' => '文章名',
        ];
    }

    public function getActile(){
        return $this->hasOne(Article::className(),['id'=>'article_id']);
    }

}
