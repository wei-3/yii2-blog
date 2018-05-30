<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username')->textInput();
echo $form->field($model,'password')->passwordInput();
echo $form->field($model,'email')->textInput(['type'=>'email']);
echo $form->field($model,'status',['inline'=>true])->radioList([0=>'禁用',1=>'启用']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();