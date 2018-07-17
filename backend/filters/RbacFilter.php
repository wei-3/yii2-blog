<?php
namespace backend\filters;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class RbacFilter extends ActionFilter{
    public function beforeAction($action)
    {
//        return false;禁止访问
//        return true;放行
        //得到当前访问的路由 $action->uniqueId
//        \Yii::$app->user->can($action->uniqueId);//检查是否有当前路由权限
        if (!\Yii::$app->user->can($action->uniqueId)){
            if (\Yii::$app->user->isGuest){
                //跳转必须执行send方法，确保页面之间跳转，否则该次操作没有被拦截，相当于返回true
//                return $action->controller->redirect(['user/login'])->send();
                //在config中的main.php文件已配置过loginUrl可以直接访问属性
                return $action->controller->redirect(\Yii::$app->user->loginUrl)->send();
            }
            throw new ForbiddenHttpException('没有此权限');
        }
        return parent::beforeAction($action);
    }
}