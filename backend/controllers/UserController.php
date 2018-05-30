<?php

namespace backend\controllers;

use backend\models\User;
use yii\data\Pagination;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query=User::find();
        $pager=new Pagination([
           'totalCount'=>$query->count(),
            'defaultPageSize'=>1,
        ]);
        $models=$query->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }

    public function actionAdd(){
        $model=new User();
        $request=\Yii::$app->request;
        if ($request->isPost){

        }
        return $this->render('add',['model'=>$model]);

    }

    public function actionEdit(){

    }
    public function actionDel(){

    }

}
