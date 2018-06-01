<?php
?>

<nav aria-label="...">
    <ul class="pager">
        <li class="previous"><a href="<?=$url?>"><span aria-hidden="true">&larr;</span> &nbsp;后退</a></li>
    </ul>
</nav>
<pre>
<center><h2><?=$model_ar->title?></h2></center>
<p class="lead text-center"><small>时间:<?=date('Y-m-d H:i',$model_ar->created_time)?>&nbsp;&nbsp;点击率:<?= $model_ar->click?></small></p>
<h4><?=$model_de->content?></h4>
</pre>
