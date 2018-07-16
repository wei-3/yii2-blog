<?php
?>
<h2>菜单列表</h2>
<table class="table">
    <tr>
        <th>名称</th>
        <th>路由</th>
        <th style="width: 200px">排序</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr data-id="<?=$model->id?>">
            <td><?=$model->name?></td>
            <td><?=$model->url?></td>
            <td><?=$model->sort?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['menu/edit','id'=>$model->id])?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
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
$del_url=\yii\helpers\Url::to(['menu/del']);
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
                       
                 }else{
                       alert(data);
                 }
               })
          }
        })
JS


));