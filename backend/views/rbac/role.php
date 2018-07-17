<?php
?>
    <nav aria-label="...">
        <ul class="pager">
            <li class="previous"><a href="<?=\yii\helpers\Url::to(['rbac/index-role'])?>"><span aria-hidden="true">&larr;</span>&nbsp;返回角色列表</a></li>
        </ul>
    </nav>
<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name')->textInput();
echo $form->field($model,'description')->textInput();
echo $form->field($model,'permissions',['inline'=>true])->checkboxList(\backend\models\RoleForm::getPermissionItems());
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();