<!doctype html>
<html>
<head>
    <meta charset="gb2312">
    <meta name="keywords" content="芒果味的汤圆个人博客" />
    <meta name="description" content="芒果味的汤圆个人博客，是一个PHP女程序员个人网站。" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div id="mnav">
            <h2><span class="navicon"></span></h2>
            <ul>
                <li><a href="<?=\yii\helpers\Url::to(['index/index'])?>">网站首页</a></li>
                <li><a href="<?=\yii\helpers\Url::to(['index/about'])?>">关于我</a></li>
                <li><a href="<?=\yii\helpers\Url::to(['index/it'])?>">IT</a></li>
                <li><a href="<?=\yii\helpers\Url::to(['index/pt'])?>">摄影</a></li>
                <li><a href="info.html">生活记录</a></li>
                <li><a href="gbook.html">留言</a></li>
            </ul>
        </div>
        <nav class="topnav" id="topnav">
            <ul>
                <li><a href="<?=\yii\helpers\Url::to(['index/index'])?>">网站首页</a></li>
                <li><a href="<?=\yii\helpers\Url::to(['index/about'])?>">关于我</a></li>
                <li><a href="<?=\yii\helpers\Url::to(['index/it'])?>">IT</a></li>
                <li><a href="<?=\yii\helpers\Url::to(['index/pt'])?>">摄影</a></li>
                <li><a href="info.html">生活记录</a></li>
                <li><a href="gbook.html">留言</a></li>
            </ul>
        </nav>
    </div>
</header>
<article>
    <h1 class="t_nav"><span>新鲜出炉，热乎乎的php小菜鸟。</span><a href="<?=\yii\helpers\Url::to(['index/index'])?>" class="n1">网站首页</a><a href="<?=\yii\helpers\Url::to(['index/about'])?>" class="n2">关于我</a></h1>
    <div class="ab_box">
        <div class="leftbox">
            <div class="newsview">
                <div class="news_infos">
                    <p>芒果味的汤圆，女，一个新鲜出炉的php小菜鸟，没有很多的经验，一边工作一边积累经验，在这一行还需继续努力。<br />
                        <br />
                        工作时间也不是很长，以前也写过自己的博客，只是后来服务器到期就一直没买服务器，再加上写的博客页面太丑。<br />
                        <br />
                        这个博客用了一个叫杨青前端设计师的模板，写博客是想记录我在工作中用到的一些技术及问题处理。<br />
                        <br />
                        在这一行学无止境的，需要多接触多学习，提高自己的技术，也请各位多多指教。<br />
                        <br />
                    <h2>About my blog</h2>
                    &nbsp;
                    <p>域 名：www.yangqq.com 创建于2011年01月12日&nbsp;</p>
                    <br />
                    <p>服务器：阿里云服务器&nbsp;&nbsp;<a href="https://www.aliyun.com/product/ecs?spm=5176.8142029.388261.634.3dbd6d3eAOCW0n" target="_blank"><span style="color:#FF0000;"><strong>前往阿里云官网购买&gt;&gt;</strong></span></a></p>
                    <br />
                    <br />
                    <center><h2>感谢阅读</h2></center>

                </div>
            </div>
        </div>
        <div class="rightbox">
            <div class="aboutme">
                <h2 class="hometitle">关于我</h2>
                <div class="avatar"> <img src="/images/avatar.gif"> </div>
                <div class="ab_con">
                    <p>QQ网名：芒果味的汤圆</p>
                    <p>职业：php程序员 </p>
                    <p>个人微信：扫码</p>
                    <p>邮箱：wei3jl@163.com</p>
                </div>
            </div>
            <div class="weixin">
                <h2 class="hometitle">微信关注</h2>
                <ul>
                    <img src="/images/gz.jpg">
                </ul>
            </div>
        </div>
    </div>
</article>
<footer>
    <p>谢谢观看! <a href="/">芒果味的汤圆个人博客</a> <a href="/">欢迎留言</a></p>
</footer>
</body>
</html>

