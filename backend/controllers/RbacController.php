<?php
namespace backend\controllers;
use backend\models\PermissionForm;
use backend\models\RoleForm;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
        $model->scenario=RoleForm::SCENARIO_ADDROLE;
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
//                $model->permissions=['user/add','user/index']; 前端提交的权限格式 如果没选权限就为null。
//复选框：没有选，不会出现字段，在这里没选也有这个字段，是因为yii框架写了一个隐藏的iput框，包含这个字段。如果选有会覆盖上面隐藏的字段
//                var_dump($model->permissions);exit();
                if ($model->permissions){
                    foreach ($model->permissions as $permissionName){
                        $permission=$auth->getPermission($permissionName);
                        $auth->addChild($role,$permission);//角色 分配 权限(传对象)
                    }
                }
                \Yii::$app->session->setFlash('success','添加角色成功!');
                return $this->redirect(['index-role']);
            }
        }
        return $this->render('role',['model'=>$model]);

    }

    //删除权限
    public function actionDelPermission(){
        $name='dd';
        //根据$name找到权限
        $name_permission=\Yii::$app->authManager->getPermission($name);
//        $db=\Yii::$app->db;
//        $sql='select * from auth_item_child';
//        $result=$db->createCommand($sql)->queryAll();
//        var_dump($result);exit();
        if($name_permission){
            $query=new Query();
            $result=$query->select('*')->from('auth_item_child')->all();
            foreach ($result as $k=>$v){
                if (in_array($name,$v)){
                    return '该权限已绑定,请先解绑';
                }
            }
            //移除权限
            \Yii::$app->authManager->remove($name_permission);
            return 'success';
        }else{
            return 'fail';
        }

    }

    //角色列表
    public function actionIndexRole(){
        $auth=\Yii::$app->authManager;
        $roles=$auth->getRoles();
        return $this->render('role-index',['roles'=>$roles]);
    }

    //修改角色
    public function actionEditRole($name){
        $auth=\Yii::$app->authManager;
//        1.显示表单（回显数据）
        //1.1根据主键获取数据
        $role=$auth->getRole($name);
//        var_dump($role);
        if ($role==null){
            throw new NotFoundHttpException('角色不存在');
        }
        //获取角色相关的权限
//        $auth->getPermissionsByRole($name);结果是$permissions=['user/add'=>Role,'user/edit'=>Role(对象)]
        $permissions=array_keys($auth->getPermissionsByRole($name));
//        var_dump($permissions);
        //1.2实例化表单模型（活动记录）
        $model=new RoleForm();
        //使用模型修改时不能回显，能回显是因为视图的模型字段有值才回显
        //调用视图，分配数据
        $model->scenario=RoleForm::SCENARIO_EDITROLE;//指定场景
        $model->name=$role->name;
        $model->description=$role->description;
        if (!empty($permissions)){
            $model->permissions=$permissions;
        }
//        var_dump($model->permissions);exit();

        // 2.接受表单数据
        $request=\Yii::$app->request;
        if ($request->isPost){
            $model->load($request->post());
            //3.验证数据，并保存到数据表
            if ($model->validate()){
                //更新角色  不能使用model的name 因为已经是更新过的name在前面已经加载了
//                var_dump($model);exit();
                $role->name=$model->name;
                $role->description=$model->description;
                $auth->update($name,$role);
                //修改角色时，只是修改了名称，权限依然在。先清除关联的权限
                $auth->removeChildren($role);
                //根据表单提交的权限关联
//                $model->permissions=[0=>'user/add',1=>'user/index']; 前端提交的权限格式 如果没选权限就为null。
//                var_dump($model->permissions);exit();
                if ($model->permissions){
                    foreach ($model->permissions as $permissionName) {
                        //根据遍历$permissionName查找权限
                        $permission = $auth->getPermission($permissionName);
                        //保存权限与角色的关系
                        $auth->addChild($role, $permission);
                    }
                }
                \Yii::$app->session->setFlash('success',$role->name.' 角色修改成功');
                return $this->redirect(['rbac/index-role']);
            }
        }
        return $this->render('role',['model'=>$model]);

    }

    public function actionDelRole(){
        $auth=\Yii::$app->authManager;
        $name=\Yii::$app->request->post('id');
        //获取当前角色
        $role=$auth->getRole($name);
        if ($role){
            //获取该角色的权限
            $permissions=$auth->getPermissionsByRole($name);
            //先判断当前角色是否有权限
            if($permissions){
                $auth->removeChildren($role);
            }
            $auth->remove($role);
            return 'success';
        }else{
            return 'fail';
        }


    }

}