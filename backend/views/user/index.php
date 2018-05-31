<?php
?>
<?php

?>
    <nav aria-label="...">
        <ul class="pager">
            <li class="previous"><a href="<?=\yii\helpers\Url::to(['user/add'])?>"> 添加用户&nbsp;<span aria-hidden="true">&rarr;</span> </a></li>
        </ul>
    </nav>
    <table class="table table-bordered table-responsive active text-info table-hover table-condensed">
        <tr class="info">
            <th class="text-center">用户ID</th>
            <th class="text-center">用户名</th>
            <th class="text-center">邮箱</th>
            <th class="text-center">状态</th>
            <th class="text-center">添加时间</th>
            <th class="text-center">更新时间</th>
            <th class="text-center">最后登录时间</th>
            <th class="text-center">最后登录ip</th>
            <th class="text-center">操作</th>
        </tr>
        <?php foreach ($models as $model):?>
            <tr data-id="<?=$model->id?>">
                <td><?=$model->id?></td>
                <td><?=$model->username?></td>
                <td><?=$model->email?></td>
                <td><?=$model->status?'启用':'禁用'?></td>
                <td><?=date('Y-m-d H:i:s',$model->created_at)?></td>
                <td><?=date('Y-m-d H:i:s',$model->updated_at)?></td>
                <td><?=$model->last_login_time?></td>
                <td><?=$model->last_login_ip?></td>
                <td>
                    <a href="<?=\yii\helpers\Url::to(['user/edit','id'=>$model->id])?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span>编辑</a>
                    <?php if ($model->status==1):?>
                        <a href="<?=\yii\helpers\Url::to(['user/hide','id'=>$model->id])?>" class="btn btn-default"><span class="glyphicon glyphicon-eye-close"></span>禁用</a>
                    <?php else:?>
                        <a href="<?=\yii\helpers\Url::to(['user/hide','id'=>$model->id])?>" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span>启用</a>
                    <?php endif;?>
                    <a href="javascript:;" class="btn btn-default del_btn"><span class="glyphicon glyphicon-eye-close"></span>删除</a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination'=>$pager,
]);
//注册js代码
$del_url=\yii\helpers\Url::to(['user/del']);
$this->registerJs(new \yii\web\JsExpression(
    <<<JS
        $('.del_btn').click(function() {
          if(confirm('确定要删除吗?')){
               var tr=$(this).closest('tr');
               var id=tr.attr('data-id');
               $.post("{$del_url}",{id:id},function(data) {
                 if(data=='success'){
                       tr.fadeToggle();
                       alert('删除成功');
                       
                 }else {
                       alert('删除失败');
                 }
               })
          }
        })
JS


));

