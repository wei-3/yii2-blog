<?php

namespace backend\controllers;

use backend\models\ArticleCategory;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class ArticleCategoryController extends \yii\web\Controller
{
    //显示文章分类页面
    public function actionIndex()
    {
        $query=ArticleCategory::find();
        //分页工具条
        $pager=new Pagination([
           //总页数
            'totalCount'=>$query->count(),
            //每页多少条
            'defaultPageSize'=>1,
        ]);
        //查询计算页面后的数据
        $models=$query->offset($pager->offset)->limit($pager->limit)->all();
//        var_dump($model);
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    //文章分类添加
    public function actionAdd(){
        //显示表单
        $model=new ArticleCategory();
        //请求方式
        $request=\Yii::$app->request;
        //判断请求方式
        if ($request->isPost){
            //加载数据
            $model->load($request->post());
            if ($model->validate()){
                //保存数据
                $model->save();
                \Yii::$app->session->setFlash('success','添加成功!');
                return $this->redirect(['article-category/index']);
            }else{
                var_dump($model->getErrors());exit();
            }
        }
        return $this->render('add',['model'=>$model]);
    }

    public function actionEdit($id){
        $model=ArticleCategory::findOne(['id'=>$id]);
        if ($model==null){
            throw new NotFoundHttpException('该分类不存在');
        }
        $request=\Yii::$app->request;
        if ($request->isPost){
            //加载数据
            $model->load($request->post());
            if ($model->validate()){
                $model->save();
                //设置提示信息
                \Yii::$app->session->setFlash('success','修改成功!');
                return $this->redirect(['article-category/index']);
            }
        }
        return $this->render('add',['model'=>$model]);
    }

    public function actionDel(){
        $id=\Yii::$app->request->post('id');
        $model=ArticleCategory::findOne(['id'=>$id])->delete();
        if ($model){
            return 'success';
        }else{
            return 'fail';
        }
    }

    public function actionHide($id){
        $model=ArticleCategory::findOne(['id'=>$id]);
        if($model){
            if ($model->status==1){
                $model->status=0;
            }else{
                $model->status=1;
            }
            $model->save();
            \Yii::$app->session->setFlash('success','修改成功!');
            return $this->redirect(['article-category/index']);
        }
    }
}
