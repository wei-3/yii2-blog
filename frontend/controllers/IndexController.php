<?php
namespace frontend\controllers;
use backend\models\Article;
use backend\models\ArticleDetail;
use yii\data\Pagination;
use yii\web\Controller;

class IndexController extends Controller{
    //博客前台首页
    public function actionIndex(){
//        $aritcles=Article::find()->where(['status'=>1])->orderBy('click desc')->all();
        $query=Article::find();
        $pager=new Pagination();
        $pager->totalCount = $query->count();
        $pager->defaultPageSize = 10;
        $aritcles=$query->orderBy('created_time desc')->offset($pager->offset)->limit($pager->limit)->all();
        return $this->renderPartial('index',['articles'=>$aritcles,'pager'=>$pager]);
    }
    //博客关于我
    public function actionAbout(){
        return $this->renderPartial('about');
    }
    //原文阅读
    public function actionRead($id){
        $model_ar=Article::findOne(['id' => $id]);
        $model_de=ArticleDetail::findOne(['article_id' => $id]);
//        $model_ar->click=$model_ar->click+1;
        return $this->renderPartial('read',['model_ar'=>$model_ar,'model_de'=>$model_de]);
    }
}