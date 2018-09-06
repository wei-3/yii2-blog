<!doctype html>
<html>
<head>
    <meta charset="gb2312">
    <title>芒果味的汤圆博客</title>
    <meta name="keywords" content="芒果味的汤圆个人博客" />
    <meta name="description" content="芒果味的汤圆个人博客，是一个PHP女程序员个人网站。" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/905bda28/css/bootstrap.css" rel="stylesheet">
    <link href="/css/site.css" rel="stylesheet">
    <link href="/css/base.css" rel="stylesheet">
    <link href="/css/index.css" rel="stylesheet">
    <link href="/css/m.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/js/modernizr.js"></script>
    <![endif]-->
    <script>
        window.onload = function ()
        {
            var oH2 = document.getElementsByTagName("h2")[0];
            var oUl = document.getElementsByTagName("ul")[0];
            oH2.onclick = function ()
            {
                var style = oUl.style;
                style.display = style.display == "block" ? "none" : "block";
                oH2.className = style.display == "block" ? "open" : ""
            }
        }
    </script>
</head>
<body>
<header>
    <div class="tophead">
        <div class="logo"><a href="/">芒果味的汤圆个人博客</a></div>
        <nav class="topnav" id="topnav">
            <ul>
                <li><a href="<?=\yii\helpers\Url::to(['index/index'])?>">网站首页</a></li>
                <li><a href="<?=\yii\helpers\Url::to(['index/about'])?>">关于我</a></li>
                <li><a href="share.html">IT</a></li>
                <li><a href="list.html">摄影</a></li>
                <li><a href="info.html">生活记录</a></li>
                <li><a href="gbook.html">留言</a></li>
            </ul>
        </nav>
    </div>
</header>
<article>
    <div class="blogs">
        <?php foreach ($articles as $article): ?>
        <li>
            <h3 class="blogtitle" style="height: 40px"><a href="<?=\yii\helpers\Url::to(['index/read','id'=>$article->id])?>"><?=$article->title?></a></h3>
            <div class="bloginfo">
                <p><?=$article->intro?></p>
            </div>
            <div class="autor"><span class="lm"><a href="/" title="<?=$article->categroy->name?>" target="_blank" class="classname"><?=$article->categroy->name?></a></span><span class="dtime"><?=date('Y-m-d',$article->created_time)?></span><span class="viewnum">浏览（<a href="/"><?=$article->click?></a>）</span><span class="readmore"><a href="<?=\yii\helpers\Url::to(['index/read','id'=>$article->id])?>">阅读原文</a></span></div>
        </li>
        <?php endforeach;?>
    </div>
    <div style="width: 300px;height:0px;margin-top: -4px;">
        <?php echo \yii\widgets\LinkPager::widget([
            'pagination'=>$pager,
            'maxButtonCount' => 5,
        ]);
        ?>
    </div>
    <div class="sidebar">
        <div class="search" style="margin-top: 58px">
            <form action="/e/search/index.php" method="post" name="searchform" id="searchform">
                <input name="keyboard" id="keyboard" class="input_text" value="请输入文章关键字" style="color: rgb(153, 153, 153);" onfocus="if(value=='请输入文章关键字'){this.style.color='#000';value=''}" onblur="if(value==''){this.style.color='#999';value='请输入关键字'}" type="text">
                <input name="show" value="title" type="hidden">
                <input name="tempid" value="1" type="hidden">
                <input name="tbname" value="news" type="hidden">
                <input name="Submit" class="input_submit" value="搜索" type="submit">
            </form>
        </div>
        <div class="paihang">
            <h2 class="hometitle"">点击排行</h2>
            <?php foreach ($sort_clicks as $sort_click):?>
            <ul>
                <li><b style="margin-bottom: 10px">&nbsp;&nbsp;<a href="/download/div/2015-04-10/746.html" target="_blank"><?=$sort_click->title?></a></b></li>
            </ul>
            <?php endforeach;?>
        </div>
        <div class="cloud">
            <h2 class="hometitle">标签云</h2>
            <ul>
                <a href="https://www.aliyun.com/">阿里云</a> <a href="https://www.oneplus.com/cn/">一加手机</a><a href="/">SumSung</a> <a href="/">青春</a> <a href="/">温暖</a> <a href="/">阳光</a> <a href="/">加油</a><a href="http://www.w3school.com.cn/php/">PHP</a> <a href="https://www.yiichina.com/">yii2</a> <a href="/">docker</a> <a href="https://www.kancloud.cn/manual/thinkphp5/">thinkphp</a> <a href="/">apidoc</a>
            </ul>
        </div>

        <div class="weixin">
            <h2 class="hometitle">官方微信</h2>
            <ul>
                <img src="/images/gz.jpg">
            </ul>
        </div>
</article>


<div class="blank"></div>
<footer>
    <p>谢谢观看! <a href="/">芒果味的汤圆个人博客</a> <a href="/">欢迎留言</a></p>
</footer>
<script src="/js/nav.js"></script>
</body>
</html>

