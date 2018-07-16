<?php
?>
    <nav aria-label="...">
        <ul class="pager">
            <li class="previous"><a href="<?=\yii\helpers\Url::to(['menu/index'])?>"><span aria-hidden="true">&larr;</span>&nbsp;返回评论首页</a></li>
        </ul>
    </nav>
<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name')->textInput();
echo $form->field($model,'parent_id')->dropDownList(\backend\models\Menu::getParents(),['prompt'=>'==请选择上级菜单==']);
echo $form->field($model,'url')->dropDownList(\backend\models\Menu::getPermissionItems(),['prompt'=>'==请选择路由==']);
echo $form->field($model,'sort')->textInput(['type'=>'number']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-primary']);
\yii\bootstrap\ActiveForm::end();