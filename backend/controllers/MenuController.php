<?php

namespace backend\controllers;

use backend\filters\RbacFilter;
use backend\models\Menu;
use yii\data\Pagination;

class MenuController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query=Menu::find();
        $pager=new Pagination([
            //总页数
            'totalCount'=>$query->count(),
            //每页多少条
            'defaultPageSize'=>100,
        ]);
        $models=$query->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }

    //添加菜单
    public function actionAdd(){
        $model=new Menu();
        $request=\Yii::$app->request;
        if ($request->isPost){
            $model->load($request->post());
//            var_dump($model);exit();
            if ($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('success','添加菜单成功');
                return $this->redirect(['menu/index']);
            }
        }
        return $this->render('add',['model'=>$model]);
    }

    //修改菜单
    public function actionEdit($id){
        $model=Menu::findOne(['id'=>$id]);
        $request=\Yii::$app->request;
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('success','修改成功!');
                return $this->redirect(['menu/index']);
            }
        }
        return $this->render('add',['model'=>$model]);
    }

    //删除菜单
    public function actionDel(){
        $id=\Yii::$app->request->post('id');
        $model=Menu::findOne(['id'=>$id]);
        $person=Menu::find()->where(['parent_id'=>$id])->all();
//        var_dump($person);exit();
        if ($model){
            if ($person){
               return '该菜单下有子菜单';
            }else{
                $model->delete();
                return 'success';
            }
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
