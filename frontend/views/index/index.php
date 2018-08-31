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
            <h3 class="blogtitle"><a href="<?=\yii\helpers\Url::to(['index/read','id'=>$article->id])?>"><?=$article->title?></a></h3>
            <div class="bloginfo">
                <p><?=$article->intro?></p>
            </div>
            <div class="autor"><span class="lm"><a href="/" title="<?=$article->categroy->name?>" target="_blank" class="classname"><?=$article->categroy->name?></a></span><span class="dtime"><?=date('Y-m-d',$article->created_time)?></span><span class="viewnum">浏览（<a href="/"><?=$article->click?></a>）</span><span class="readmore"><a href="<?=\yii\helpers\Url::to(['index/read','id'=>$article->id])?>">阅读原文</a></span></div>
        </li>
        <?php endforeach;?>
    </div>
    <div style="width: 300px;height:0px;margin: 0px">
        <?php echo \yii\widgets\LinkPager::widget([
            'pagination'=>$pager,
            'maxButtonCount' => 5,
        ]);
        ?>
    </div>
    <div class="sidebar">
        <div class="about">
            <div class="avatar"> <img src="/images/avatar.gif" alt=""> </div>
        </div>
        <div class="search">
            <form action="/e/search/index.php" method="post" name="searchform" id="searchform">
                <input name="keyboard" id="keyboard" class="input_text" value="请输入关键字" style="color: rgb(153, 153, 153);" onfocus="if(value=='请输入关键字'){this.style.color='#000';value=''}" onblur="if(value==''){this.style.color='#999';value='请输入关键字'}" type="text">
                <input name="show" value="title" type="hidden">
                <input name="tempid" value="1" type="hidden">
                <input name="tbname" value="news" type="hidden">
                <input name="Submit" class="input_submit" value="搜索" type="submit">
            </form>
        </div>
        <div class="paihang">
            <h2 class="hometitle">点击排行</h2>
            <ul>
                <li><b><a href="/download/div/2015-04-10/746.html" target="_blank">【活动作品】柠檬绿兔小白个人博客模板30...</a></b>
                    <p><i><img src="images/t02.jpg"></i>展示的是首页html，博客页面布局格式简单，没有复杂的背景，色彩局部点缀，动态的幻灯片展示，切换卡，标...</p>
                </li>
                <li><b><a href="/download/div/2014-02-19/649.html" target="_blank"> 个人博客模板（2014草根寻梦）30...</a></b>
                    <p><i><img src="images/b03.jpg"></i>2014第一版《草根寻梦》个人博客模板简单、优雅、稳重、大气、低调。专为年轻有志向却又低调的草根站长设...</p>
                </li>
                <li><b><a href="/download/div/2013-08-08/571.html" target="_blank">黑色质感时间轴html5个人博客模板30...</a></b>
                    <p><i><img src="images/b04.jpg"></i>黑色时间轴html5个人博客模板颜色以黑色为主色，添加了彩色作为网页的一个亮点，导航高亮显示、banner图片...</p>
                </li>
                <li><b><a href="/download/div/2013-08-08/571.html" target="_blank">黑色质感时间轴html5个人博客模板30...</a></b>
                    <p><i><img src="images/b04.jpg"></i>黑色时间轴html5个人博客模板颜色以黑色为主色，添加了彩色作为网页的一个亮点，导航高亮显示、banner图片...</p>
                </li>
            </ul>
        </div>
        <div class="paihang">
            <h2 class="hometitle">站长推荐</h2>
            <ul>
                <li><b><a href="/download/div/2015-04-10/746.html" target="_blank">【活动作品】柠檬绿兔小白个人博客模板30...</a></b>
                    <p><i><img src="images/t02.jpg"></i>展示的是首页html，博客页面布局格式简单，没有复杂的背景，色彩局部点缀，动态的幻灯片展示，切换卡，标...</p>
                </li>
                <li><b><a href="/download/div/2014-02-19/649.html" target="_blank"> 个人博客模板（2014草根寻梦）30...</a></b>
                    <p><i><img src="images/b03.jpg"></i>2014第一版《草根寻梦》个人博客模板简单、优雅、稳重、大气、低调。专为年轻有志向却又低调的草根站长设...</p>
                </li>
                <li><b><a href="/download/div/2013-08-08/571.html" target="_blank">黑色质感时间轴html5个人博客模板30...</a></b>
                    <p><i><img src="images/b04.jpg"></i>黑色时间轴html5个人博客模板颜色以黑色为主色，添加了彩色作为网页的一个亮点，导航高亮显示、banner图片...</p>
                </li>
                <li><b><a href="/download/div/2013-08-08/571.html" target="_blank">黑色质感时间轴html5个人博客模板30...</a></b>
                    <p><i><img src="images/b04.jpg"></i>黑色时间轴html5个人博客模板颜色以黑色为主色，添加了彩色作为网页的一个亮点，导航高亮显示、banner图片...</p>
                </li>
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

