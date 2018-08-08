<nav aria-label="...">
    <ul class="pager">
        <li class="previous"><a href="<?=\yii\helpers\Url::to(['user/index'])?>"><span aria-hidden="true">&larr;</span>&nbsp;返回用户首页</a></li>
    </ul>
</nav>
<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username')->textInput();
echo $form->field($model,'password')->passwordInput();
echo $form->field($model,'confirm_password')->passwordInput();
echo $form->field($model,'email')->textInput(['type'=>'email']);
echo $form->field($model,'status',['inline'=>true])->radioList([0=>'禁用',1=>'启用']);
echo $form->field($model,'roles',['inline'=>true])->checkboxList(\backend\models\User::getRole());
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();