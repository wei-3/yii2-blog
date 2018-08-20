<?php
?>
    <nav class="navbar ">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="pager nav navbar-nav">
                    <li class="previous"><a href="<?=\yii\helpers\Url::to(['article/add'])?>"> 添加文章&nbsp;<span aria-hidden="true">&rarr;</span> </a></li>
                </ul>
                <form class="navbar-form navbar-right" action="<?=\yii\helpers\Url::to(['article/index'])?>"  method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search title intro" name="search[text]">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search categroy" name="search[categroy]">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search status" name="search[status]">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
<table class="table table-bordered table-responsive active text-info table-hover table-condensed">
    <tr class="info">
        <th class="text-center">文章ID</th>
        <th class="text-center">文章标题</th>
        <th class="text-center" style="width: 300px">文章简介</th>
        <th class="text-center">文章分类</th>
        <th class="text-center">排序</th>
        <th class="text-center">状态</th>
        <th class="text-center" style="width: 330px">操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr data-id="<?=$model->id?>">
            <td><?=$model->id?></td>
            <td><?=$model->title?></td>
            <td><?=$model->intro?></td>
            <td><?=$model->categroy->name?></td>
            <td><?=$model->sort?></td>
            <td><?=$model->status?'显示':'隐藏'?></td>

            <td><a href="<?=\yii\helpers\Url::to(['article/detail','id'=>$model->id])?>" class="btn btn-default detail_btn"><span class="glyphicon glyphicon-th-list"></span>文章详情</a>
                <a href="<?=\yii\helpers\Url::to(['article/edit','id'=>$model->id])?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span>编辑</a>
                <?php if ($model->status==1):?>
                    <a href="<?=\yii\helpers\Url::to(['article/hide','id'=>$model->id])?>" class="btn btn-default"><span class="glyphicon glyphicon-eye-close"></span>隐藏</a>
                <?php else:?>
                    <a href="<?=\yii\helpers\Url::to(['article/hide','id'=>$model->id])?>" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span>显示</a>
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
$del_url=\yii\helpers\Url::to(['article/del']);
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
