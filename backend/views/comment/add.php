<?php
?>
<nav aria-label="...">
    <ul class="pager">
        <li class="previous"><a href="<?=\yii\helpers\Url::to(['comment/index'])?>"><span aria-hidden="true">&larr;</span>&nbsp;返回评论首页</a></li>
    </ul>
</nav>
<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username')->textInput();
echo $form->field($model,'content')->textarea(['rows'=>5]);
echo $form->field($model,'top',['inline'=>true])->radioList(['不置顶','置顶']);
echo $form->field($model,'praise')->textInput(['type'=>'number']);
echo $form->field($model,'report',['inline'=>true])->radioList(['举报','不举报']);
echo $form->field($model,'article_id')->dropDownList(\yii\helpers\ArrayHelper::map($model_ac,'id','title'));
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-primary']);
\yii\bootstrap\ActiveForm::end();