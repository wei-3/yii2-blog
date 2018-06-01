<?php
/* @var $this yii\web\View */
?>
    <nav aria-label="...">
        <ul class="pager">
            <li class="previous"><a href="<?=\yii\helpers\Url::to(['article-category/add'])?>"> 添加文章分类&nbsp;<span aria-hidden="true">&rarr;</span> </a></li>
        </ul>
    </nav>
<table class="table table-bordered table-responsive active text-info table-hover table-condensed">
    <tr class="info">
        <th class="text-center">ID</th>
        <th class="text-center">文章分类名称</th>
        <th class="text-center">排序</th>
        <th class="text-center">状态</th>
        <th class="text-center" style="width: 330px">操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr data-id="<?=$model->id?>">
            <td><?=$model->id?></td>
            <td class="text-center"><?=$model->name?></td>
            <td><?=$model->sort?></td>
            <td><?=$model->status?'显示':'隐藏'?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['article-category/edit','id'=>$model->id])?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span>编辑</a>
                <?php if ($model->status==1):?>
                <a href="<?=\yii\helpers\Url::to(['article-category/hide','id'=>$model->id])?>" class="btn btn-default"><span class="glyphicon glyphicon-eye-close"></span>隐藏</a>
                <?php else:?>
                <a href="<?=\yii\helpers\Url::to(['article-category/hide','id'=>$model->id])?>" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span>显示</a>
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
    $del_url=\yii\helpers\Url::to(['article-category/del']);
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

