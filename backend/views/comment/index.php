<nav aria-label="...">
    <ul class="pager">
        <li class="previous"><a href="<?=\yii\helpers\Url::to(['comment/add'])?>"> 添加评论&nbsp;<span aria-hidden="true">&rarr;</span> </a></li>
    </ul>
</nav>
<table class="table table-bordered table-responsive active text-info table-hover table-condensed">
    <tr class="info">
        <th class="text-center">用户ID</th>
        <th class="text-center">用户名</th>
        <th class="text-center">内容</th>
        <th class="text-center">是否置顶</th>
        <th class="text-center">点赞数量</th>
        <th class="text-center">是否被举报</th>
        <th class="text-center">文章名</th>
        <th class="text-center">时间</th>
        <th class="text-center">操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr data-id="<?=$model->id?>">
            <td><?=$model->id?></td>
            <td><?=$model->username?></td>
            <td><?=$model->content?></td>
            <td><?=$model->top?'置顶':'不置顶'?></td>
            <td><?=$model->praise?></td>
            <td><?=$model->report?'被举报':'未举报'?></td>
            <td><?=$model->actile->title?></td>
            <td><?=date('Y-m-d H:i:s',$model->created_at)?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['comment/edit','id'=>$model->id])?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="javascript:;" class="btn btn-default del_btn"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination'=>$pager,
]);
//注册js代码
$del_url=\yii\helpers\Url::to(['comment/del']);
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

