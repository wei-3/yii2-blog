<?php
?>
<nav aria-label="...">
    <ul class="pager">
        <li class="previous"><a href="<?=\yii\helpers\Url::to(['rbac/add-role'])?>"> 添加角色&nbsp;<span aria-hidden="true">&rarr;</span> </a></li>
    </ul>
</nav>
<table class="table table-bordered table-responsive active text-info table-hover table-condensed">
    <tr class="info">
        <th class="text-center">名称</th>
        <th class="text-center">路由</th>
        <th class="text-center">排序</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr data-id="<?=$model->id?>">
            <td><?=$model->name?></td>
            <td><?=$model->url?></td>
            <td><?=$model->sort?></td>
        </tr>
    <?php endforeach;?>
</table>
