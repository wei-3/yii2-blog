<?php
?>
<h2>菜单列表</h2>
<table class="table">
    <tr>
        <th>名称</th>
        <th>路由</th>
        <th>排序</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr data-id="<?=$model->id?>">
            <td><?=$model->name?></td>
            <td><?=$model->url?></td>
            <td><?=$model->sort?></td>
        </tr>
    <?php endforeach;?>
</table>
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination'=>$pager,
]);