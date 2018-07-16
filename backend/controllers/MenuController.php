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
            'defaultPageSize'=>1,
        ]);
        $models=$query->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('index',['models'=>$models]);
    }

}
