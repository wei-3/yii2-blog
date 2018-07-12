<?php
namespace backend\controllers;
use backend\models\PermissionForm;
use backend\models\RoleForm;
use yii\web\Controller;

class RbacController extends Controller{
    //添加权限
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
                $per->description=$model->description;
                //2.保存到数据表
                $auth->add($per);
                \Yii::$app->session->setFlash('success','添加权限成功');
                return $this->redirect(['index-permission']);
            }
        }
        return $this->render('permission',['model'=>$model]);
    }
    //权限列表
    public function actionIndexPermission(){
        $auth=\Yii::$app->authManager;//本身不支持分页
        $pers=$auth->getPermissions();
        return $this->render('permission-index',['pers'=>$pers]);
    }

    //添加角色，并赋权限
    public function actionAddRole(){
        $model=new RoleForm();
        $request=\Yii::$app->request;
        if ($request->isPost){
            $model->load($request->post());
            if ($model->validate()){
                $auth=\Yii::$app->authManager;
                //保存角色
                $role=$auth->createRole($model->name);
                $role->description=$model->description;
                //保存数据表
                $auth->add($role);
                //给角色分权限
//                $model->permissions=['user/add','user/index']; 前端提交的权限格式 如果没选权限就为null
//                var_dump($model->permissions);exit();
                if ($model->permissions){
                    foreach ($model->permissions as $permissionName){
                        $permission=$auth->getPermission($permissionName);
                        $auth->addChild($role,$permission);//角色 分配 权限(传对象)
                    }
                }
                return $this->redirect(['role-index']);
            }
        }
        return $this->render('role',['model'=>$model]);

    }



}