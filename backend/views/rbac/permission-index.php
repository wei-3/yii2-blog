<?php
?>
<nav aria-label="...">
    <ul class="pager">
        <li class="previous"><a href="<?=\yii\helpers\Url::to(['rbac/add-permission'])?>"> 添加权限&nbsp;<span aria-hidden="true">&rarr;</span> </a></li>
    </ul>
</nav>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>权限名称</th>
        <th>权限描述</th>
        <th style="width: 330px">操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($pers as $per):?>
        <tr data-id="<?=$per->name?>">
            <td><?=$per->name?></td>
            <td><?=$per->description?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['rbac/edit-permission','name'=>$per->name])?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span>编辑</a>
                <a href="javascript:;" class="btn btn-default del_btn"><span class="glyphicon glyphicon-eye-close"></span>删除</a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php

$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
$this->registerCssFile('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css');
$this->registerJsFile('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',['depends'=>\yii\web\JqueryAsset::className()]);
$this->registerJsFile('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js',['depends'=>\yii\web\JqueryAsset::className()]);
//注册js代码
$del_url=\yii\helpers\Url::to(['rbac/del-permission']);
$this->registerJs(new \yii\web\JsExpression(
    <<<JS
// $(document).ready(function() {
//          $('#example').DataTable( {
//              "language": {
//                  "lengthMenu": "每页 _MENU_ 条记录",
//                  "zeroRecords": "没有找到记录",
//                  "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
//                  "infoEmpty": "无记录",
//                  "infoFiltered": "(从 _MAX_ 条记录过滤)",
//                  "search": "搜索：",
//                  "ZeroRecords": "没有记录",
//                  "paginate":{
//                      "next":"下一页",
//                      "previous":"上一页"
//                  
//                  }
//              }
//          } );
//  } );
$(document).ready(function() {
    $('#example').DataTable();
} );

       $(".del_btn").click(function() {
          if(confirm('确定要删除吗')){
              var tr=$(this).closest('tr');
              var id=tr.attr('data-id');
              // console.log(id);
              $.post("{$del_url}",{id:id},function(data) {
                if(data=='success'){
                     tr.fadeToggle();
                     alert('删除成功');
                }
                else{
                     alert('删除失败');
                }
              });
          }
        });
JS
));
?>