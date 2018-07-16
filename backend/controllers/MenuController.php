<?php

namespace backend\controllers;

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

}
