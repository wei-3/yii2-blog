<?php

namespace backend\controllers;

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
            'defaultPageSize'=>1,
        ]);
        $models=$query->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }

    public function actionAdd(){
        $model_co=new Comment();
        $request=\Yii::$app->request;
//        var_dump($request);exit();
        if($request->isPost){
//            var_dump($request->post());exit();
            $model_co->load($request->post());
            $model_co->createtime=time();
            if ($model_co->validate()){
                $model_co->save();
                \Yii::$app->session->setFlash('success','添加成功!');
                return $this->redirect(['comment/index']);
            }else{
                throw new NotFoundHttpException();
            }
        }
        $model_ac=Article::find()->all();
        return $this->render('add',['model_co'=>$model_co,'model_ac'=>$model_ac]);
    }

    public function actionEdit(){}

    public function actionDel(){}

    public function actionHide(){}

}
