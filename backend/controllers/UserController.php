<?php

namespace backend\controllers;

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
            'defaultPageSize'=>1,
        ]);
        $models=$query->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }

    public function actionAdd(){
        $model=new User();
        $model->scenario=User::SCENARIO_ADD;//指定当前场景
        $request=\Yii::$app->request;
        if ($request->isPost){
            $model->load($request->post());
            if ($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['index']);
            }

        }
        return $this->render('add',['model'=>$model]);

    }

    public function actionEdit($id){
        $model=User::findOne(['id'=>$id]);
        //为了防止恶意修改传过来的id
        if ($model==null){
            throw new NotFoundHttpException('用户不存在');
        }
        $request=\Yii::$app->request;
        if ($request->isPost){
            $model->load($request->post());
            if ($model->validate()){
                $model->save();
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

}
