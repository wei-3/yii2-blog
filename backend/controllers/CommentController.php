<?php

namespace backend\controllers;

use backend\filters\RbacFilter;
use backend\models\Article;
use backend\models\Comment;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class CommentController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query=Comment::find();
        $pager=new Pagination([
            'totalCount'=>$query->count(),
            'defaultPageSize'=>100,
        ]);
        $models=$query->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }

    public function actionAdd(){
        $model=new Comment();
        $request=\Yii::$app->request;
//        var_dump($request);exit();
        if($request->isPost){
//            var_dump($request->post());exit();
            $model->load($request->post());
            $model->created_at=time();
            if ($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('success','添加成功!');
                return $this->redirect(['comment/index']);
            }else{
                throw new NotFoundHttpException();
            }
        }
        $model_ac=Article::find()->all();
        return $this->render('add',['model'=>$model,'model_ac'=>$model_ac]);
    }

    public function actionEdit($id){
        $model=Comment::findOne(['id'=>$id]);
        $request=\Yii::$app->request;
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('success','修改成功!');
                return $this->redirect(['comment/index']);
            }
        }
        $model_ac=Article::find()->all();
        return $this->render('add',['model'=>$model,'model_ac'=>$model_ac]);
    }

    public function actionDel(){
        $id=\Yii::$app->request->post('id');
        $model=Comment::findOne(['id'=>$id]);
        if ($model){
            $model->delete();
            return 'success';
        }else{
            return 'fail';
        }
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
