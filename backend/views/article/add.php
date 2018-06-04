<nav aria-label="...">
    <ul class="pager">
        <li class="previous"><a href="<?=\yii\helpers\Url::to(['article/index'])?>"><span aria-hidden="true">&larr;</span>&nbsp;返回文章首页</a></li>
    </ul>
</nav>
<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model_article,'title')->textInput();
echo $form->field($model_article,'intro')->textarea(['rows'=>3]);
echo $form->field($model_article,'article_category_id')->dropDownList(\yii\helpers\ArrayHelper::map($model_categorys,'id','name'));
echo $form->field($model_article,'sort')->textInput(['type'=>'number']);
// echo $form->field($model_detail,'content')->textarea(['rows'=>5]);
echo $form->field($model_detail,'content')->widget('kucha\ueditor\UEditor',[
    'clientOptions'=>[
        //编辑区域大小
        'initialFrameHeight' => '200',
        //设置语言
        'lang' =>'en', //中文为 zh-cn
    ]
]);
echo $form->field($model_article,'status',['inline'=>true])->radioList(['隐藏','显示']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-primary']);
\yii\bootstrap\ActiveForm::end();