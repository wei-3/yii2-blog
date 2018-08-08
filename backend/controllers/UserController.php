<?php

namespace backend\controllers;

use backend\filters\RbacFilter;
use backend\models\LoginFrom;
use backend\models\ModifyFrom;
use backend\models\User;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query=User::find();
        $pager=new Pagination([
           'totalCount'=>$query->count(),
            'defaultPageSize'=>100,
        ]);
        $models=$query->offset($pager->offset)->limit($pager->limit)->all();
//        var_dump($models);exit();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }

    public function actionAdd(){
        $model=new User();
        $auth=\Yii::$app->authManager;
        $model->scenario=User::SCENARIO_ADD;//指定当前场景
        $request=\Yii::$app->request;
        if ($request->isPost){
            $model->load($request->post());
            if ($model->validate()){
                if ($model->password===$model->confirm_password){
                    $model->save();
                    $id=\Yii::$app->db->getLastInsertID();
                    if ($model->roles){
                        foreach ($model->roles as $roleName){
                            $role=$auth->getRole($roleName);
                            $auth->assign($role,$id);
                        }
                    }
                    \Yii::$app->session->setFlash('success','添加成功');
                    return $this->redirect(['index']);
                }else{
                    $model->addError('confirm_password','两次密码不一致');
                }
            }

        }
        return $this->render('add',['model'=>$model]);

    }

    public function actionEdit($id){
        $model=User::findOne(['id'=>$id]);
        $auth=\Yii::$app->authManager;
        $roles=$auth->getRolesByUser($id);
        $model->roles=array_keys($roles);
        //为了防止恶意修改传过来的id
        if ($model==null){
            throw new NotFoundHttpException('用户不存在');
        }
        $request=\Yii::$app->request;
        if ($request->isPost){
            $model->load($request->post());
            if ($model->validate()){
                $model->save();
                $auth->revokeAll($id);
                if($model->roles){
//                    var_dump(111);
                    foreach ($model->roles as $roleName){
                        $role=$auth->getRole($roleName);
                        $auth->assign($role,$id);
                    }
                }
                \Yii::$app->session->setFlash('success','修改成功');
                return $this->redirect(['index']);
            }

        }
        return $this->render('add',['model'=>$model]);

    }
    public function actionDel(){
        $id=\Yii::$app->request->post('id');
        $model=User::findOne(['id'=>$id])->delete();
        if ($model){
            return 'success';
        }else{
            return 'fail';
        }
    }

    public function actionHide($id){
        $model = User::findOne(['id' => $id]);
        if ($model) {
            if ($model->status == 1) {
                $model->status = 0;
            } else {
                $model->status = 1;
            }
            $model->save();
            \Yii::$app->session->setFlash('success', '修改成功!');
            return $this->redirect(['user/index']);
        }else{
            throw new NotFoundHttpException('用户不存在');
        }
    }

    public function actionLogin(){
        //显示登录表单
        $model=new LoginFrom();
        $request=\Yii::$app->request;
        if ($request->isPost){
            $model->load($request->post());
            if ($model->validate()){
                //认证
                if ($model->login()){//模型的login
                    \Yii::$app->session->setFlash('success','登录成功');
                    return $this->redirect(['user/index']);
                }
            }
        }
        return $this->render('login',['model'=>$model]);
    }

    //注销
    public function actionLogout(){
        \Yii::$app->user->logout();
        \Yii::$app->session->setFlash('success','退出成功');
        return $this->redirect(['login']);
    }

    //修改自己的密码
    public function actionPwd(){
        if (\Yii::$app->user->isGuest){
            return $this->redirect(['login']);
        }
        $model=new ModifyFrom();
        $request=\Yii::$app->request;
        if ($request->isPost){
            $model->load($request->post());
            if ($model->validate()){
                $user=\Yii::$app->user->identity;
                $user->password=$model->new_pwd;//自动加密,在保存之前
                $user->save();
            }
        }
        return $this->render('pwd',['model'=>$model]);
    }

    public function behaviors()
    {
        return [
            'rbac'=>[
                'class'=>RbacFilter::className(),
                'except'=>['logout','login','captcha','pwd','error']
            ]
        ];
    }

}
