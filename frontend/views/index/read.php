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
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/comment.css">
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
    <div class="infos" style="width: 100%">
        <div class="newsview">
            <h3 class="news_title"><?=$model_ar->title?></h3>
            <div class="autor"><span class="lm"><a href="/" title="<?=$model_ar->categroy->name?>" target="_blank" class="classname"><?=$model_ar->categroy->name?></a></span><span class="dtime"><?=date('Y-m-d',$model_ar->created_time)?></span><span class="viewnum">浏览（<?=$model_ar->click?>）</span></div>
            <div class="news_about"><strong>简介:</strong><?=$model_ar->intro?></div>
            <div class="news_infos">
                <?=$model_de->content?>
                &nbsp; </div>
        </div>
        <div class="share"> </div>
        <div class="nextinfo">
            <p>上一篇：<a href="/news/life/2018-03-13/804.html">作为一个设计师,如果遭到质疑你是否能恪守自己的原则?</a></p>
            <p>下一篇：<a href="/news/life/">返回列表</a></p>
        </div>
        <div class="news_pl">
            <h2>文章评论</h2>
                <div class="gbko">
                   <div class="alert alert-info">
                       <span id="commentCount">已有 4 条评论</span>
                   </div>
                    <div class="commentAll" style="width: 100%">
                        <!--评论区域 begin-->
                        <div class="reviewArea clearfix alert">
                            <textarea class="content comment-input" placeholder="Please enter a comment&hellip;" onkeyup="keyUP(this)"></textarea>
                            <a href="javascript:;" class="plBtn">评论</a>
                        </div>
                        <!--评论区域 end-->
                        <!--回复区域 begin-->
                        <div class="comment-show" style="width: 100%">
                            <div class="comment-show-con clearfix">
                                <div class="comment-show-con-img pull-left"><img src="/images/header-img-comment_03.png" alt=""></div>
                                <div class="comment-show-con-list pull-left clearfix">
                                    <div class="pl-text clearfix">
                                        <a href="#" class="comment-size-name">张三 : </a>
                                        <span class="my-pl-con">&nbsp;来啊 造作啊!</span>
                                    </div>
                                    <div class="date-dz">
                                        <span class="date-dz-left pull-left comment-time">2017-5-2 11:11:39</span>
                                        <div class="date-dz-right pull-right comment-pl-block">
                                            <a href="javascript:;" class="removeBlock">删除</a>
                                            <a href="javascript:;" class="date-dz-pl pl-hf hf-con-block pull-left">回复</a>
                                            <span class="pull-left date-dz-line">|</span>
                                            <a href="javascript:;" class="date-dz-z pull-left"><i class="date-dz-z-click-red"></i>赞 (<i class="z-num">666</i>)</a>
                                        </div>
                                    </div>
                                    <div class="hf-list-con"></div>
                                </div>
                            </div>
                        </div>
                        <!--回复区域 end-->
                    </div>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-2">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="用户名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-2">
                                <input type="password" class="form-control" id="inputPassword3" placeholder="密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">登录</button>
                            </div>
                        </div>
                    </form>


                </div>
        </div>

    </div>
</article>
<footer>
    <p>Design by <a href="/">杨青个人博客</a> <a href="/">蜀ICP备11002373号-1</a></p>
</footer>
</body>
</html>
