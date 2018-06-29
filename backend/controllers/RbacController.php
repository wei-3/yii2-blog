<?php
namespace backend\controllers;
use backend\models\PermissionForm;
use yii\web\Controller;

class RbacController extends Controller{
    public function actionAddPermission(){
        $model =new PermissionForm();
        $request=\Yii::$app->request;
        if ($request->isPost){
            $model->load($request->post());
            if ($model->validate()){
                $auth=\Yii::$app->authManager;
                //添加权限
                //1.创建权限
                $per=$auth->createPermission($model->name);
                //权限描述
                $per->description=$model->desc;
                //2.保存到数据表
                $auth->add($per);
                \Yii::$app->session->setFlash('success','添加权限成功');
                return $this->redirect(['permission-index']);
            }
        }
        return $this->render('permission',['model'=>$model]);
    }

    public function actionPerssionIndex(){

    }
}