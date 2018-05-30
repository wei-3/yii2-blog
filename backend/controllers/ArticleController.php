<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleDetail;
use yii\data\Pagination;

class ArticleController extends \yii\web\Controller
{
    //显示文章页面
    public function actionIndex()
    {
        $query=Article::find();
        $pager=new Pagination([
           'totalCount'=>$query->count(),
            'defaultPageSize'=>1,
        ]);
        $models=$query->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    //文章添加
    public function actionAdd(){
        $model_article=new Article();
        $model_detail=new ArticleDetail();
        $request=\Yii::$app->request;
        if ($request->isPost){
            $model_article->load($request->post());
            $model_detail->load($request->post());
            if ($model_article->validate()&&$model_detail->validate()){
                $model_article->save();
                $model_detail->article_id=$model_article->id;
                $model_detail->save();
                \Yii::$app->session->setFlash('success','添加成功!');
                return $this->redirect(['article/index']);
            }
        }
        //实例化文章分类模型查询所有数据
        $model_categorys=ArticleCategory::find()->all();
        return $this->render('add',['model_article'=>$model_article,'model_detail'=>$model_detail,'model_categorys'=>$model_categorys]);
    }
    public function actionEdit($id){
        $model_article=Article::findOne(['id'=>$id]);
        $model_detail=ArticleDetail::findOne(['article_id'=>$id]);
        $request=\Yii::$app->request;
        if ($request->isPost){
            $model_detail->load($request->post());
            $model_article->load($request->post());
            if ($model_article->validate()&&$model_detail->validate()){
                $model_article->save();
                $model_detail->save();
                //设置提示信息
                \Yii::$app->session->setFlash('success','修改成功!');
                return $this->redirect(['article/index']);
            }

        }
        $model_categorys=ArticleCategory::find()->all();
        return $this->render('add',['model_article'=>$model_article,'model_detail'=>$model_detail,'model_categorys'=>$model_categorys]);

    }
    public function actionDel(){
        $id=\Yii::$app->request->post('id');
        $model_article=Article::findOne(['id'=>$id])->delete();
        $model_detail=ArticleDetail::findOne(['article_id'=>$id])->delete();
        if ($model_article&&$model_detail){
            return 'success';
        }else{
            return 'fail';
        }
    }

    public function actionHide($id)
    {
        $model = Article::findOne(['id' => $id]);
        if ($model) {
            if ($model->status == 1) {
                $model->status = 0;
            } else {
                $model->status = 1;
            }
            $model->save();
            \Yii::$app->session->setFlash('success', '修改成功!');
            return $this->redirect(['article/index']);
        }
    }

}
