<?php
namespace frontend\controllers;
use backend\models\Article;
use backend\models\ArticleDetail;
use yii\data\Pagination;
use yii\web\Controller;

class IndexController extends Controller{
    //博客前台首页
    public function actionIndex(){
        $sort_clicks=Article::find()->where(['status'=>1])->orderBy('click DESC')->limit(10)->all();
//        var_dump($sort_clicks);exit();
        $query=Article::find();
        $pager=new Pagination();
        $pager->totalCount = $query->count();
        $pager->defaultPageSize = 9;
        $aritcles=$query->where(['status'=>1])->orderBy('created_time desc')->offset($pager->offset)->limit($pager->limit)->all();
        return $this->renderPartial('index',['articles'=>$aritcles,'sort_clicks'=>$sort_clicks,'pager'=>$pager]);
    }
    //博客关于我
    public function actionAbout(){
        return $this->renderPartial('about');
    }
    //原文阅读
    public function actionRead($id){
        $model_ar=Article::findOne(['id' => $id]);
        $model_de=ArticleDetail::findOne(['article_id' => $id]);
        $model_ar->click=$model_ar->click+1;
        $model_ar->save();
        return $this->renderPartial('read',['model_ar'=>$model_ar,'model_de'=>$model_de]);
    }

    public function actionIt(){
        $query= $query=Article::find();
        //点击
        $sort_clicks=$query->where(['status'=>1])->orderBy('click DESC')->limit(10)->all();
        //文章
        $pager=new Pagination();
        $pager->totalCount = $query->count();
        $pager->defaultPageSize = 10;
        $models=$query->where(['article_category_id'=>1])->orderBy('created_time DESC')->offset($pager->offset)->limit($pager->limit)->all();
        return $this->renderPartial('it',['models'=>$models,'sort_clicks'=>$sort_clicks,'pager'=>$pager]);
    }
    public function actionPt(){
        $query= $query=Article::find();
        //点击
        $sort_clicks=$query->where(['status'=>1])->orderBy('click DESC')->limit(10)->all();
        //文章
        $pager=new Pagination();
        $pager->totalCount = $query->count();
        $pager->defaultPageSize = 9;
        $models=$query->where(['article_category_id'=>2])->orderBy('created_time DESC')->offset($pager->offset)->limit($pager->limit)->all();
        return $this->renderPartial('it',['models'=>$models,'sort_clicks'=>$sort_clicks,'pager'=>$pager]);
    }
}