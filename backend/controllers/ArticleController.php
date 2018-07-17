<?php

namespace backend\controllers;

use backend\filters\RbacFilter;
use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleDetail;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

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
        if ($model_article==null){
            throw new NotFoundHttpException('该文章不存在');
        }
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
        }else{
            throw new NotFoundHttpException('该文章不存在');
        }
    }

    public function actionDetail($id){
        $model_ar = Article::findOne(['id' => $id]);
        $model_de = ArticleDetail::findOne(['article_id' => $id]);
        $url=\Yii::$app->request->referrer;
        if ($model_ar){
            return $this->render('detail',['model_ar'=>$model_ar,'model_de'=>$model_de,'url'=>$url]);
        }else{
            throw new NotFoundHttpException('该文章不存在');
        }

    }
    public function actionTest(){
        var_dump(\Yii::getAlias("@webroot"));
    }
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' =>[
                    "imageUrlPrefix"  => "",//图片访问路径前缀
                    "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                    "imageRoot" => \Yii::getAlias("@webroot"),
                ]
            ],
        ];
    }

    public function behaviors()
    {
        return [
            'rbac'=>[
                'class'=>RbacFilter::className(),
                'except'=>['error']
            ]
        ];
    }
}
