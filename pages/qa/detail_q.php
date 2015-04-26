


<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<meta name="renderer" content="webkit" />
<meta property="qc:admins" content="15317273575564615446375" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui, maximum-scale=1, user-scalable=no" />
<meta name="alexaVerifyID" content="LkzCRJ7rPEUwt6fVey2vhxiw1vQ"/>
<title>有什么方法可以让别人看不到我的js代码 - SegmentFault</title>

<meta name="description" content="感觉所有js代码都曝露出来，辛苦做出来的代码很快被人抄袭，怎么可以隐藏一下呢" />

    <meta name="keywords" content="javascript" />

<link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="SegmentFault" />
<link rel="shortcut icon" href="//static.segmentfault.com/global/img/favicon.30f7204d.ico" />
<link rel="apple-touch-icon" href="//static.segmentfault.com/global/img/touch-icon.c78b1075.png">
<meta name="userId" value="" id="SFUserId" />
<meta name="userRank" value="" id="SFUserRank" />

<link rel="alternate" type="application/atom+xml" title="SegmentFault 最新问题" href="/feeds/questions">
<link rel="alternate" type="application/atom+xml" title="SegmentFault 最新文章" href="/feeds/blogs">



    <link rel="stylesheet" href="//static.segmentfault.com/build/global/css/global.676c5944.css" />
            <link rel="stylesheet" href="//static.segmentfault.com/build/qa/css/qa_all.fe492d19.css" />
        <link rel="stylesheet" href="//static.segmentfault.com/build/global/css/responsive.2e038079.css" />

<!--[if lt IE 9]>
    <link rel="stylesheet" href="//static.segmentfault.com/global/css/ie.css?" />
    <script src="//static.segmentfault.com/global/js/html5shiv.js?"></script>
    <script src="//static.segmentfault.com/global/js/respond.js?"></script>
<![endif]-->

</head>
<body class="qa-question">
<!--[if lt IE 9]>
    <div class="alert alert-danger topframe" role="alert">你的浏览器实在<strong>太太太太太太旧了</strong>，放学别走，升级完浏览器再说 <a target="_blank" class="alert-link" href="http://browsehappy.com">立即升级</a></div>
<![endif]-->



<div class="global-nav">
    <nav class="container nav">
        <div class="dropdown m-menu">
            <a href="javascript:void(0);" id="dLabel" class="visible-xs-block m-toptools" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-align-justify"></span>
                <span class="mobile-menu__unreadpoint"></span>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                <li class="mobile-menu__item"><a href="/questions/newest">问答</a></li>
                <li class="mobile-menu__item"><a href="/blogs">文章</a></li>
                <li class="mobile-menu__item"><a href="/events">活动</a></li>
                <li class="mobile-menu__item"><a href="/tags">标签</a></li>
                <li class="mobile-menu__item"><a href="/users">榜单</a></li>
                <li class="mobile-menu__item"><a href="/sites">子站</a></li>
                            </ul>
        </div>

        <h1 class="logo"><a href="/">SegmentFault</a></h1>

                <a href="/user/login" class="visible-xs-block pull-right m-ask m-toptools"><span class="glyphicon glyphicon-log-in"></span></a>
        
        <form action="/search" class="header-search pull-left hidden-sm hidden-xs">
            <button type="submit" class="btn btn-link"><span class="sr-only">搜索</span><span class="glyphicon glyphicon-search"></span></button>
            <input id="searchBox" name="q" type="text" placeholder="输入关键字搜索" class="form-control" value="">
        </form>

        <ul class="menu list-inline pull-left hidden-xs">
            <li class="menu__item"><a href="/questions/newest">问答</a></li>
            <li class="menu__item"><a href="/blogs">文章</a></li>
            <li class="menu__item"><a href="/events">活动</a></li>
            <li class="menu__item"><a href="/tags">标签</a></li>
            <li class="menu__item"><a href="/users">榜单</a></li>
            <li class="menu__item dropdown hoverDropdown">
                <a data-toggle="dropdown" href="/sites" class="more dropdownBtn">
                    &middot;&middot;&middot;<span class="sr-only">更多</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/sites">子站</a></li>
                                    </ul>
            </li>
        </ul>

        <ul class="opts pull-right list-inline hidden-xs">
                    <!-- <li class="opts__item">赶快加入吧 <a id="sfLogin" href="/user/login" class="SFLogin em ml10" onClick="_gaq.push(['_trackEvent', 'Button', 'Click', 'Login']);">立即登录</a></li> -->
            <li class="opts__item message has-unread">
                <a target="_blank" href="/tour">
                    <span class="sr-only">消息</span>
                    <span id="messageCount" class="glyphicon glyphicon-envelope"></span>
                </a>
            </li>
            <li class="opts__item">
                <a href="/user/login" class="SFLogin em ml10" onClick="_gaq.push(['_trackEvent', 'Button', 'Click', 'Login']);">立即登录</a>
            </li>
                    </ul>
    </nav>
</div>

<div class="wrap">

    <div class="post-topheader">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <ol class="breadcrumb">
                        <li><a href="/questions/newest">问答</a></li>
                                                <li class="active">问答详情</li>
                    </ol>

                    <h1 class="h3 title" id="questionTitle" data-id="1010000002706115"><a href="/q/1010000002706115">有什么方法可以让别人看不到我的js代码</a></h1>

                    <div class="author">
                        <a href="/u/ecepa_xi" class="mr5"><img class="avatar-24 mr10" src="//static.segmentfault.com/global/img/user-64.png" alt="ECEPA_禧戏"><strong>ECEPA_禧戏</strong></a> <strong class="text-black mr10">254</strong>
                        2 天前 提问
                                                                    </div>
                </div>
                <div class="col-md-3">
                    <ul class="widget-action--ver list-unstyled">
                        <li>
                                                        <button type="button" id="sideFollow" class="btn btn-success btn-sm" data-id="1010000002706115" data-do="follow" data-type="question" data-toggle="tooltip" data-placement="right" title="关注后将获得更新提醒">关注</button>
                                                        <strong>11</strong> 关注
                        </li>
                        <li>
                                                        <button type="button" id="sideBookmark" class="btn btn-default btn-sm" data-id="1010000002706115" data-type="question">收藏</button>
                                                        <strong id="sideBookmarked">0</strong> 收藏，<strong class="no-stress">327</strong> 浏览
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- end .post-topheader -->

    <div class="container mt30">
        <div class="row">
            <div class="col-xs-12 col-md-9 main">
                <article class="widget-question__item">
                    <div class="post-col">
                        <div class="widget-vote">
                            <button type="button"
                                class="like"
                                data-id="1010000002706115"
                                data-type="question"
                                data-do="like"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="问题对人有帮助，内容完整，我也想知道答案">
                                <span class="sr-only">问题对人有帮助，内容完整，我也想知道答案</span>
                            </button>
                            <span class="count">-7</span>
                            <button
                                type="button"
                                class="hate"
                                data-id="1010000002706115"
                                data-type="question"
                                data-do="hate"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="问题没有实际价值，缺少关键内容，没有改进余地">
                                <span class="sr-only">问题没有实际价值，缺少关键内容，没有改进余地</span>
                            </button>
                        </div><!-- end .widget-vote -->
                    </div>

                    <div class="post-offset">

                        <div class="question fmt">
<p>感觉所有js代码都曝露出来，辛苦做出来的代码很快被人抄袭，怎么可以隐藏一下呢</p>
</div>

                        <ul class="taglist--inline mb20">
                                                        <li class="tagPopup"><a class="tag" href="/t/javascript" data-toggle="popover" data-placement="top" data-original-title="javascript" data-id="1040000000089436" data-img="http://sfault-avatar.b0.upaiyun.com/195/823/1958237468-1040000000089436_huge100" >javascript</a></li>
                                                    </ul>

                                                                        <p class="alert alert-warning">
                            <strong>这个问题已被隐藏</strong>                        </p>
                                                                                                
                        <div class="post-opt">
                            <ul class="list-inline mb0">
                                <li><a href="/q/1010000002706115">链接</a></li>
                                                                <li><a href="javascript:void(0);" class="comments" data-id="1010000002706115" data-target="#comment-1010000002706115">3 评论</a></li>

                                
                                
                                
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                                    <ul class="dropdown-menu dropdown-menu-left">
                                        <li><a href="#911" data-id="1010000002706115" data-toggle="modal" data-target="#911" data-type="question" data-typetext="问题">举报</a></li>

                                                                                
                                        
                                        
                                                                            </ul>
                                </li>
                                                            </ul>
                        </div>
                        <ul class="widget-comments hidden" id="comment-1010000002706115" data-id="1010000002706115">
                        <li class="widget-comments__form row">
                                    <div class="col-md-12">
                    请先 <a class="commentLogin" href="javascript:void(0);">登录</a> 后评论
                </div>
            
    </li><!-- /.widget-comments__form -->
    </ul><!-- /.widget-comments -->


                    </div><!-- end .post-offset -->
                </article>

                    <div class="widget-answers">
        <div class="btn-group pull-right" role="group">
            <a href="/q/1010000002706115#answers-title" id="sortby-rank" class="btn btn-default btn-xs active">默认排序</a>
            <a href="?sort=created#answers-title" id="sortby-created" class="btn btn-default btn-xs">时间排序</a>
        </div>

        <h2 class="title h4 mt30 mb20 post-title" id="answers-title">9 个回答</h2>

                    

<article class="clearfix widget-answers__item accepted" id="a-1020000002706179">
    <div class="post-col">
        <div class="widget-vote">
            <button type="button"
                class="like"
                data-id="1020000002706179"
                data-type="answer"
                data-do="like"
                data-toggle="tooltip"
                data-placement="top"
                title="答案对人有帮助，有参考价值">
                <span class="sr-only">答案对人有帮助，有参考价值</span>
            </button>
            <span class="count">2</span>
            <button type="button"
                class="hate"
                data-id="1020000002706179"
                data-type="answer"
                data-do="hate"
                data-toggle="tooltip"
                data-placement="bottom"
                title="答案没帮助，是错误的答案，答非所问">
                <span class="sr-only">答案没帮助，是错误的答案，答非所问</span>
            </button>

        </div>
        <div class="accepted-flag">采纳</div>    </div>

    <div class="post-offset">
        <a href="/u/qianjiahao"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/672/040/67204040-5539cfc8133bc_big64" alt=""></a>
        <strong><a href="/u/qianjiahao" class="mr5">qianjiahao</a> 1.3k</strong>

        <span class="ml10 text-muted">
            2 天前 回答
                        &middot; <a href="/q/1010000002706115/a-1020000002706179/revision">2 天前 更新</a>
                    </span>

        <div class="answer fmt mt10">
            
<p>还是建议拥有开源精神，相互学习，共同进步，只有这样才能推动这个行业的前进。</p>

<p>如果真要这样的，可以用压缩工具，把代码压缩，这样别人就算看了也看不懂。比如gulp-uglify。</p>

        </div>

        
        
        <div class="post-opt">
            <ul class="list-inline mb0">
                
                <li><a href="/q/1010000002706115/a-1020000002706179">链接</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000002706179" data-target="#comment-1020000002706179"> 评论</a></li>
                                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="#911" data-id="1020000002706179" data-toggle="modal" data-target="#911" data-type="answer" data-typetext="答案">举报</a></li>
                                                                    </ul>
                </li>
                            </ul>
        </div>

        <ul class="widget-comments hidden" id="comment-1020000002706179" data-id="1020000002706179">
                        <li class="widget-comments__form row">
                                    <div class="col-md-12">
                    请先 <a class="commentLogin" href="javascript:void(0);">登录</a> 后评论
                </div>
            
    </li><!-- /.widget-comments__form -->
    </ul><!-- /.widget-comments -->


    </div>
</article><!-- /article -->

        
                    

<article class="clearfix widget-answers__item" id="a-1020000002706136">
    <div class="post-col">
        <div class="widget-vote">
            <button type="button"
                class="like"
                data-id="1020000002706136"
                data-type="answer"
                data-do="like"
                data-toggle="tooltip"
                data-placement="top"
                title="答案对人有帮助，有参考价值">
                <span class="sr-only">答案对人有帮助，有参考价值</span>
            </button>
            <span class="count">3</span>
            <button type="button"
                class="hate"
                data-id="1020000002706136"
                data-type="answer"
                data-do="hate"
                data-toggle="tooltip"
                data-placement="bottom"
                title="答案没帮助，是错误的答案，答非所问">
                <span class="sr-only">答案没帮助，是错误的答案，答非所问</span>
            </button>

        </div>
            </div>

    <div class="post-offset">
        <a href="/u/ibusybox"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/401/377/4013779080-1030000000643470_big64" alt=""></a>
        <strong><a href="/u/ibusybox" class="mr5">ibusybox</a> 180</strong>

        <span class="ml10 text-muted">
            2 天前 回答
                    </span>

        <div class="answer fmt mt10">
            
<p>有。你自己开发一个浏览器：）<br>
这种想法不是很对。你肯定也参考过别人很多优秀代码的吧。当别人copy你代码时候，也是对你的的一种认可，何乐而不为呢？</p>

        </div>

        
        
        <div class="post-opt">
            <ul class="list-inline mb0">
                
                <li><a href="/q/1010000002706115/a-1020000002706136">链接</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000002706136" data-target="#comment-1020000002706136">1 评论</a></li>
                                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="#911" data-id="1020000002706136" data-toggle="modal" data-target="#911" data-type="answer" data-typetext="答案">举报</a></li>
                                                                    </ul>
                </li>
                            </ul>
        </div>

        <ul class="widget-comments hidden" id="comment-1020000002706136" data-id="1020000002706136">
                        <li class="widget-comments__form row">
                                    <div class="col-md-12">
                    请先 <a class="commentLogin" href="javascript:void(0);">登录</a> 后评论
                </div>
            
    </li><!-- /.widget-comments__form -->
    </ul><!-- /.widget-comments -->


    </div>
</article><!-- /article -->

                    

<article class="clearfix widget-answers__item" id="a-1020000002706152">
    <div class="post-col">
        <div class="widget-vote">
            <button type="button"
                class="like"
                data-id="1020000002706152"
                data-type="answer"
                data-do="like"
                data-toggle="tooltip"
                data-placement="top"
                title="答案对人有帮助，有参考价值">
                <span class="sr-only">答案对人有帮助，有参考价值</span>
            </button>
            <span class="count">3</span>
            <button type="button"
                class="hate"
                data-id="1020000002706152"
                data-type="answer"
                data-do="hate"
                data-toggle="tooltip"
                data-placement="bottom"
                title="答案没帮助，是错误的答案，答非所问">
                <span class="sr-only">答案没帮助，是错误的答案，答非所问</span>
            </button>

        </div>
            </div>

    <div class="post-offset">
        <a href="/u/vvtommy"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/543/769/543769141-1030000000155055_big64" alt=""></a>
        <strong><a href="/u/vvtommy" class="mr5">vvtommy</a> 1.1k</strong>

        <span class="ml10 text-muted">
            2 天前 回答
                    </span>

        <div class="answer fmt mt10">
            
<p>不要整天想这些事儿，多想想怎么提高自己。</p>

<p>Gmail 代码都在那儿，抄个试试？</p>

        </div>

        
        
        <div class="post-opt">
            <ul class="list-inline mb0">
                
                <li><a href="/q/1010000002706115/a-1020000002706152">链接</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000002706152" data-target="#comment-1020000002706152">1 评论</a></li>
                                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="#911" data-id="1020000002706152" data-toggle="modal" data-target="#911" data-type="answer" data-typetext="答案">举报</a></li>
                                                                    </ul>
                </li>
                            </ul>
        </div>

        <ul class="widget-comments hidden" id="comment-1020000002706152" data-id="1020000002706152">
                        <li class="widget-comments__form row">
                                    <div class="col-md-12">
                    请先 <a class="commentLogin" href="javascript:void(0);">登录</a> 后评论
                </div>
            
    </li><!-- /.widget-comments__form -->
    </ul><!-- /.widget-comments -->


    </div>
</article><!-- /article -->

                    

<article class="clearfix widget-answers__item" id="a-1020000002707167">
    <div class="post-col">
        <div class="widget-vote">
            <button type="button"
                class="like"
                data-id="1020000002707167"
                data-type="answer"
                data-do="like"
                data-toggle="tooltip"
                data-placement="top"
                title="答案对人有帮助，有参考价值">
                <span class="sr-only">答案对人有帮助，有参考价值</span>
            </button>
            <span class="count">2</span>
            <button type="button"
                class="hate"
                data-id="1020000002707167"
                data-type="answer"
                data-do="hate"
                data-toggle="tooltip"
                data-placement="bottom"
                title="答案没帮助，是错误的答案，答非所问">
                <span class="sr-only">答案没帮助，是错误的答案，答非所问</span>
            </button>

        </div>
            </div>

    <div class="post-offset">
        <a href="/u/pantao"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/782/629/782629240-55326e6158d01_big64" alt=""></a>
        <strong><a href="/u/pantao" class="mr5">pantao</a> 1.3k</strong>

        <span class="ml10 text-muted">
            1 天前 回答
                    </span>

        <div class="answer fmt mt10">
            
<p>这可能需要一个强大的后端支持</p>

        </div>

        
        
        <div class="post-opt">
            <ul class="list-inline mb0">
                
                <li><a href="/q/1010000002706115/a-1020000002707167">链接</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000002707167" data-target="#comment-1020000002707167"> 评论</a></li>
                                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="#911" data-id="1020000002707167" data-toggle="modal" data-target="#911" data-type="answer" data-typetext="答案">举报</a></li>
                                                                    </ul>
                </li>
                            </ul>
        </div>

        <ul class="widget-comments hidden" id="comment-1020000002707167" data-id="1020000002707167">
                        <li class="widget-comments__form row">
                                    <div class="col-md-12">
                    请先 <a class="commentLogin" href="javascript:void(0);">登录</a> 后评论
                </div>
            
    </li><!-- /.widget-comments__form -->
    </ul><!-- /.widget-comments -->


    </div>
</article><!-- /article -->

                    

<article class="clearfix widget-answers__item" id="a-1020000002706238">
    <div class="post-col">
        <div class="widget-vote">
            <button type="button"
                class="like"
                data-id="1020000002706238"
                data-type="answer"
                data-do="like"
                data-toggle="tooltip"
                data-placement="top"
                title="答案对人有帮助，有参考价值">
                <span class="sr-only">答案对人有帮助，有参考价值</span>
            </button>
            <span class="count">1</span>
            <button type="button"
                class="hate"
                data-id="1020000002706238"
                data-type="answer"
                data-do="hate"
                data-toggle="tooltip"
                data-placement="bottom"
                title="答案没帮助，是错误的答案，答非所问">
                <span class="sr-only">答案没帮助，是错误的答案，答非所问</span>
            </button>

        </div>
            </div>

    <div class="post-offset">
        <a href="/u/bf"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/212/692/2126928047-549a0fc27ae91_big64" alt=""></a>
        <strong><a href="/u/bf" class="mr5">bf</a> 4.8k</strong>

        <span class="ml10 text-muted">
            2 天前 回答
                        &middot; <a href="/q/1010000002706115/a-1020000002706238/revision">2 天前 更新</a>
                    </span>

        <div class="answer fmt mt10">
            
<p>自己寫解析器和編譯器，將 js 編譯爲一種人類看不懂的語言即可</p>

<p>類似於一些商業 vm 殼</p>

<p>至於混淆代碼，其實真沒什麼用，用一些輔助工具和大量時間一點一點重構代碼就ok</p>

        </div>

        
        
        <div class="post-opt">
            <ul class="list-inline mb0">
                
                <li><a href="/q/1010000002706115/a-1020000002706238">链接</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000002706238" data-target="#comment-1020000002706238"> 评论</a></li>
                                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="#911" data-id="1020000002706238" data-toggle="modal" data-target="#911" data-type="answer" data-typetext="答案">举报</a></li>
                                                                    </ul>
                </li>
                            </ul>
        </div>

        <ul class="widget-comments hidden" id="comment-1020000002706238" data-id="1020000002706238">
                        <li class="widget-comments__form row">
                                    <div class="col-md-12">
                    请先 <a class="commentLogin" href="javascript:void(0);">登录</a> 后评论
                </div>
            
    </li><!-- /.widget-comments__form -->
    </ul><!-- /.widget-comments -->


    </div>
</article><!-- /article -->

                    

<article class="clearfix widget-answers__item" id="a-1020000002707139">
    <div class="post-col">
        <div class="widget-vote">
            <button type="button"
                class="like"
                data-id="1020000002707139"
                data-type="answer"
                data-do="like"
                data-toggle="tooltip"
                data-placement="top"
                title="答案对人有帮助，有参考价值">
                <span class="sr-only">答案对人有帮助，有参考价值</span>
            </button>
            <span class="count">1</span>
            <button type="button"
                class="hate"
                data-id="1020000002707139"
                data-type="answer"
                data-do="hate"
                data-toggle="tooltip"
                data-placement="bottom"
                title="答案没帮助，是错误的答案，答非所问">
                <span class="sr-only">答案没帮助，是错误的答案，答非所问</span>
            </button>

        </div>
            </div>

    <div class="post-offset">
        <a href="/u/yanhaijing"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/476/226/476226347-1030000000336645_big64" alt=""></a>
        <strong><a href="/u/yanhaijing" class="mr5">颜海镜</a> 724</strong>

        <span class="ml10 text-muted">
            1 天前 回答
                    </span>

        <div class="answer fmt mt10">
            
<p>放心吧，放在那没人看的</p>

        </div>

        
        
        <div class="post-opt">
            <ul class="list-inline mb0">
                
                <li><a href="/q/1010000002706115/a-1020000002707139">链接</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000002707139" data-target="#comment-1020000002707139"> 评论</a></li>
                                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="#911" data-id="1020000002707139" data-toggle="modal" data-target="#911" data-type="answer" data-typetext="答案">举报</a></li>
                                                                    </ul>
                </li>
                            </ul>
        </div>

        <ul class="widget-comments hidden" id="comment-1020000002707139" data-id="1020000002707139">
                        <li class="widget-comments__form row">
                                    <div class="col-md-12">
                    请先 <a class="commentLogin" href="javascript:void(0);">登录</a> 后评论
                </div>
            
    </li><!-- /.widget-comments__form -->
    </ul><!-- /.widget-comments -->


    </div>
</article><!-- /article -->

                    

<article class="clearfix widget-answers__item" id="a-1020000002706369">
    <div class="post-col">
        <div class="widget-vote">
            <button type="button"
                class="like"
                data-id="1020000002706369"
                data-type="answer"
                data-do="like"
                data-toggle="tooltip"
                data-placement="top"
                title="答案对人有帮助，有参考价值">
                <span class="sr-only">答案对人有帮助，有参考价值</span>
            </button>
            <span class="count">0</span>
            <button type="button"
                class="hate"
                data-id="1020000002706369"
                data-type="answer"
                data-do="hate"
                data-toggle="tooltip"
                data-placement="bottom"
                title="答案没帮助，是错误的答案，答非所问">
                <span class="sr-only">答案没帮助，是错误的答案，答非所问</span>
            </button>

        </div>
            </div>

    <div class="post-offset">
        <a href="/u/pomoho"><img class="avatar-24" src="//static.segmentfault.com/global/img/user-64.png" alt=""></a>
        <strong><a href="/u/pomoho" class="mr5">pomoho</a> 4</strong>

        <span class="ml10 text-muted">
            2 天前 回答
                    </span>

        <div class="answer fmt mt10">
            
<p>放心吧，你的代码网上肯定找到</p>

        </div>

        
        
        <div class="post-opt">
            <ul class="list-inline mb0">
                
                <li><a href="/q/1010000002706115/a-1020000002706369">链接</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000002706369" data-target="#comment-1020000002706369"> 评论</a></li>
                                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="#911" data-id="1020000002706369" data-toggle="modal" data-target="#911" data-type="answer" data-typetext="答案">举报</a></li>
                                                                    </ul>
                </li>
                            </ul>
        </div>

        <ul class="widget-comments hidden" id="comment-1020000002706369" data-id="1020000002706369">
                        <li class="widget-comments__form row">
                                    <div class="col-md-12">
                    请先 <a class="commentLogin" href="javascript:void(0);">登录</a> 后评论
                </div>
            
    </li><!-- /.widget-comments__form -->
    </ul><!-- /.widget-comments -->


    </div>
</article><!-- /article -->

                    

<article class="clearfix widget-answers__item" id="a-1020000002707962">
    <div class="post-col">
        <div class="widget-vote">
            <button type="button"
                class="like"
                data-id="1020000002707962"
                data-type="answer"
                data-do="like"
                data-toggle="tooltip"
                data-placement="top"
                title="答案对人有帮助，有参考价值">
                <span class="sr-only">答案对人有帮助，有参考价值</span>
            </button>
            <span class="count">0</span>
            <button type="button"
                class="hate"
                data-id="1020000002707962"
                data-type="answer"
                data-do="hate"
                data-toggle="tooltip"
                data-placement="bottom"
                title="答案没帮助，是错误的答案，答非所问">
                <span class="sr-only">答案没帮助，是错误的答案，答非所问</span>
            </button>

        </div>
            </div>

    <div class="post-offset">
        <a href="/u/kfchen"><img class="avatar-24" src="//static.segmentfault.com/global/img/user-64.png" alt=""></a>
        <strong><a href="/u/kfchen" class="mr5">kfchen</a> 18</strong>

        <span class="ml10 text-muted">
            1 天前 回答
                    </span>

        <div class="answer fmt mt10">
            
<p>用你牛B的代码亮瞎他们的眼睛，自然就看不到了</p>

        </div>

        
        
        <div class="post-opt">
            <ul class="list-inline mb0">
                
                <li><a href="/q/1010000002706115/a-1020000002707962">链接</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000002707962" data-target="#comment-1020000002707962"> 评论</a></li>
                                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="#911" data-id="1020000002707962" data-toggle="modal" data-target="#911" data-type="answer" data-typetext="答案">举报</a></li>
                                                                    </ul>
                </li>
                            </ul>
        </div>

        <ul class="widget-comments hidden" id="comment-1020000002707962" data-id="1020000002707962">
                        <li class="widget-comments__form row">
                                    <div class="col-md-12">
                    请先 <a class="commentLogin" href="javascript:void(0);">登录</a> 后评论
                </div>
            
    </li><!-- /.widget-comments__form -->
    </ul><!-- /.widget-comments -->


    </div>
</article><!-- /article -->

        
                <div class="clearfix widget-answers__item text-center">
            <a href="#" class="showIgnored">1 个答案被忽略</a>
        </div>
        
                    

<article class="clearfix widget-answers__item ignored" id="a-1020000002707221">
    <div class="post-col">
        <div class="widget-vote">
            <button type="button"
                class="like"
                data-id="1020000002707221"
                data-type="answer"
                data-do="like"
                data-toggle="tooltip"
                data-placement="top"
                title="答案对人有帮助，有参考价值">
                <span class="sr-only">答案对人有帮助，有参考价值</span>
            </button>
            <span class="count">1</span>
            <button type="button"
                class="hate"
                data-id="1020000002707221"
                data-type="answer"
                data-do="hate"
                data-toggle="tooltip"
                data-placement="bottom"
                title="答案没帮助，是错误的答案，答非所问">
                <span class="sr-only">答案没帮助，是错误的答案，答非所问</span>
            </button>

        </div>
            </div>

    <div class="post-offset">
        <a href="/u/hermaproditus"><img class="avatar-24" src="http://sfault-avatar.b0.upaiyun.com/773/004/773004987-1030000000450644_big64" alt=""></a>
        <strong><a href="/u/hermaproditus" class="mr5">hermaproditus</a> 76</strong>

        <span class="ml10 text-muted">
            1 天前 回答
                    </span>

        <div class="answer fmt mt10">
            
<p>对呀,我长这么美我也很怕被别人看到,大家都想上我呢!</p>

        </div>

                <p class="alert alert-warning">
            <strong>「已忽略」</strong>：答非所问，不符合答题要求        </p>
        
        
        <div class="post-opt">
            <ul class="list-inline mb0">
                
                <li><a href="/q/1010000002706115/a-1020000002707221">链接</a></li>
                                <li><a href="javascript:void(0);" class="comments" data-id="1020000002707221" data-target="#comment-1020000002707221">1 评论</a></li>
                                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="#911" data-id="1020000002707221" data-toggle="modal" data-target="#911" data-type="answer" data-typetext="答案">举报</a></li>
                                                                    </ul>
                </li>
                            </ul>
        </div>

        <ul class="widget-comments hidden" id="comment-1020000002707221" data-id="1020000002707221">
                        <li class="widget-comments__form row">
                                    <div class="col-md-12">
                    请先 <a class="commentLogin" href="javascript:void(0);">登录</a> 后评论
                </div>
            
    </li><!-- /.widget-comments__form -->
    </ul><!-- /.widget-comments -->


    </div>
</article><!-- /article -->

        
        <div class="text-center">
            
        </div>
    </div><!-- /.widget-answers -->

            
                <h4>撰写答案</h4>
        <input type="hidden" id="draftId" value="">
        <input type="hidden" value="1010000002706115" id="questionId">
        <form action="/question/1010000002706115/answers/add" method="post" class="editor-wrap">
            <div class="editor" id="questionText">
                <textarea id="answerEditor" name="text" class="form-control" rows="4" placeholder="撰写答案..." ></textarea>
            </div>
            <div id="answerSubmit" class="hide mt15 clearfix">
                <div class="checkbox pull-left">
                    <label><input type="checkbox" class="" id="shareToWeibo">
                        同步到新浪微博</label>
                </div>
                <div class="pull-right">
                    <span id="editorStatus" class="hidden text-muted">

                    </span>
                    <a id="dropIt" href="javascript:void(0);" class="mr10 hidden">
                        [舍弃]
                    </a>
                    <button type="submit" id="answerIt" data-id="1010000002706115" class="btn btn-lg btn-primary ml20">提交回答</button>
                </div>
            </div>
        </form>
            
                    
                                    <div class="widget-welcome-question mt20 mb20 hidden-xs widget-welcome">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="title h4">不要错过该问题的后续解决方案</h2>
            <p>如果你没找到答案，记得登录关注哦，大家会尽全力帮你解决的 ^___^</p>
        </div>
        <form id="user">
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-4 pr0">
                        <input type="text" class="form-control" placeholder="用户名" name="name" required>
                    </div>
                    <div class="col-sm-4 pr0">
                        <input type="text" class="form-control" placeholder="Email" name="mail" id="mail" required>
                    </div>
                    <div class="col-sm-4 pr0">
                        <input type="password" class="form-control" placeholder="密码" name="password" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary btn-block">注册</button>
            </div>
            <div class="col-sm-10 mt10 captcha-part" style="display:none;">
                <div class="row">
                    <div class="col-sm-4 pr0">
                        <input type="text" class="form-control" id="captcha" name="captcha" placeholder="请输入验证码" disabled required>
                    </div>
                    <div class="col-sm-4 pr0">
                        <a id="reloadCaptcha"  href="javascript:void(0)"><img src="" height="35" /></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

                            </div><!-- /.main -->


            
<div class="col-xs-12 col-md-3 side">
    <div class="sfad-sidebar">
    <div class="sfad-item" data-adn="ad-981179" id="adid-981179">
    <button class="close" type="button" aria-hidden="true">&times;</button>
</div>

</div>


        <div class="widget-box no-border">
        <h2 class="h4 widget-box__title">相似问题</h2>
        <ul class="widget-links list-unstyled">
                            <li class="widget-links__item"><a title="javascript是面向对象的，怎么体现javascript的继承关系？" href="/q/1010000000350507">javascript是面向对象的，怎么体现javascript的继承关系？</a>
                                    <small class="text-muted">
                                                    6 回答
                                                                    </small>
                                </li>
                            <li class="widget-links__item"><a title="JavaScript 入门哪本书最好？" href="/q/1010000002706634">JavaScript 入门哪本书最好？</a>
                                    <small class="text-muted">
                                                    10 回答
                                                                             |                             已解决
                                            </small>
                                </li>
                            <li class="widget-links__item"><a title="现在有好多javascript的库，还要学精javascript吗？" href="/q/1010000000464783">现在有好多javascript的库，还要学精javascript吗？</a>
                                    <small class="text-muted">
                                                    14 回答
                                                                    </small>
                                </li>
                            <li class="widget-links__item"><a title="《高性能javascript》和《javascript设计模式》这两本书怎么样？后者好像评价不好" href="/q/1010000002602574">《高性能javascript》和《javascript设计模式》这两本书怎么样？后者好像评价不好</a>
                                    <small class="text-muted">
                                                    6 回答
                                                                             |                             已解决
                                            </small>
                                </li>
                            <li class="widget-links__item"><a title="如何学习JavaScript" href="/q/1010000000580653">如何学习JavaScript</a>
                                    <small class="text-muted">
                                                    3 回答
                                                                             |                             已解决
                                            </small>
                                </li>
                            <li class="widget-links__item"><a title="如何进一步提高自己的javascript能力" href="/q/1010000000125906">如何进一步提高自己的javascript能力</a>
                                    <small class="text-muted">
                                                    10 回答
                                                                             |                             已解决
                                            </small>
                                </li>
                            <li class="widget-links__item"><a title="vim里的高亮javascript的javascript.vim 已经放到syntax里了，但是不行。" href="/q/1010000000188179">vim里的高亮javascript的javascript.vim 已经放到syntax里了，但是不行。</a>
                                    <small class="text-muted">
                                                    2 回答
                                                                    </small>
                                </li>
                            <li class="widget-links__item"><a title="网上有哪些不错的javascript资源推荐？" href="/q/1010000000095623">网上有哪些不错的javascript资源推荐？</a>
                                    <small class="text-muted">
                                                    7 回答
                                                                             |                             已解决
                                            </small>
                                </li>
                            <li class="widget-links__item"><a title="javascript自动补全" href="/q/1010000000636826">javascript自动补全</a>
                                    <small class="text-muted">
                                                    12 回答
                                                                    </small>
                                </li>
                            <li class="widget-links__item"><a title="什么是 javascript shell" href="/q/1010000002477040">什么是 javascript shell</a>
                                    <small class="text-muted">
                                                    3 回答
                                                                             |                             已解决
                                            </small>
                                </li>
                    </ul>
    </div>
    <div class="widget-share" data-text="有什么方法可以让别人看不到我的js代码">
</div>

    
</div><!-- /.side -->

        </div>
    </div>
</div>

<div id="shareToWeiboModal" class="modal" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">分享</h4>
            </div>
            <div class="modal-body">
                <p class="sfModal-content">
                    分享到微博？
                </p>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default dont-likeweibo" data-dismiss="modal">取消并且不再弹出</button>
                <a href="" id="shareLink" class="btn btn-primary done-btn" target="_blank" onclick="$('#shareToWeiboModal').modal('hide')">分享</a>
            </div>
        </div>
    </div>
</div>

<div id="delete-modal" class="modal widget-911">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title radio-del question-close-only">关闭<span class="type-911">问题</span>（请谨慎操作）</h4>
                <h4 class="modal-title radio-del question-delete-only">删除<span class="type-911">问题</span>（请谨慎操作）</h4>
                <h4 class="modal-title radio-del answer-delete-only">删除<span class="type-911">回答</span>（请谨慎操作）</h4>
                <h4 class="modal-title radio-del answer-ignore-only">忽略<span class="type-911">回答</span></h4>
            </div>
            <div class="modal-body">
                <p>
                    <strong class="required radio-del question-close-only">关闭理由：</strong>
                    <strong class="required radio-del question-delete-only answer-delete-only">删除理由：</strong>
                    <strong class="required radio-del answer-ignore-only">忽略理由：</strong>
                </p>
                <div id="reportDescription">
                    <div class="radio-del radio all">
                        <label>
                            <input type="radio" name="descRadio" value="垃圾广告" />
                            垃圾广告
                        </label>
                    </div>
                    <div class="radio-del radio question-close-only">
                        <label>
                            <input type="radio" name="descRadio" value="与已有问题重复">
                            与已有问题重复（请编辑该提问指向已有相同问题）
                        </label>
                    </div>
                    <div class="radio-del radio answer-ignore-only">
                        <label>
                            <input type="radio" name="descRadio" value="答非所问，不符合答题要求">
                            答非所问，不符合答题要求
                        </label>
                    </div>
                    <div class="radio-del radio answer-ignore-only">
                        <label>
                            <input type="radio" name="descRadio" value="宜作评论而非答案">
                            宜作评论而非答案
                        </label>
                    </div>
                    <div class="radio-del radio all">
                        <label>
                            <input type="radio" name="descRadio" value="带有人身攻击、辱骂、仇恨等违反条款的内容">
                            带有人身攻击、辱骂、仇恨等违反条款的内容
                        </label>
                    </div>
                    <div class="radio-del radio all">
                        <label>
                            <input type="radio" name="descRadio" value="内容质量差，或不适合在本网站出现">
                            内容质量差，或不适合在本网站出现
                        </label>
                    </div>
                    <div class="radio-del radio question-close-only question-delete-only">
                        <label>
                            <input type="radio" name="descRadio" value="无意义讨论型问题">
                            无意义讨论型问题
                        </label>
                    </div>
                    <div class="radio-del radio all btwRadio">
                        <label>
                            <input type="radio" name="descRadio" value="">
                            其他原因（请补充说明）
                        </label>
                    </div>
                    <div class="btw" style="display:none;">
                        <p class="mt20"><strong>补充说明：</strong></p>
                        <textarea class="form-control" rows="3" name="description" id="deleteDesc"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-danger" id="submit-delete">提交</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="911" class="modal widget-911">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">举报<span class="type-911">问题</span></h4>
            </div>
            <div class="modal-body">
                <p><strong class="required">举报理由：</strong></p>
                <div id="reportDescription">
                <div class="radio-911 radio all">
                    <label>
                        <input type="radio" name="descRadio" value="垃圾广告">
                        垃圾广告
                    </label>
                </div>
                <div class="radio-911 radio all">
                    <label>
                        <input type="radio" name="descRadio" value="带有人身攻击、辱骂、仇恨等违反条款的内容">
                        带有人身攻击、辱骂、仇恨等违反条款的内容
                    </label>
                </div>
                <div class="radio-911 radio question-only">
                    <label>
                        <input type="radio" name="descRadio" value="与已有问题重复">
                        与已有问题重复（请编辑该提问指向已有相同问题）
                    </label>
                </div>
                <div class="radio-911 radio question-only">
                    <label>
                        <input type="radio" name="descRadio" value="内容质量差，或不适合在本网站出现">
                        内容质量差，或不适合在本网站出现
                    </label>
                </div>
                <div class="radio-911 radio answer-only">
                    <label>
                        <input type="radio" name="descRadio" value="答非所问，不符合答题要求">
                        答非所问，不符合答题要求
                    </label>
                </div>
                <div class="radio-911 radio all" id="btwRadio">
                    <label>
                        <input type="radio" name="descRadio" value="">
                        其他原因（请补充说明）
                    </label>
                </div>
                <div class="hide btw">
                    <p class="mt20"><strong>补充说明：</strong></p>
                    <textarea class="form-control" rows="3" autocomplete="false" id="911Desc"></textarea>
                </div>
                                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" id="911Submit" class="btn btn-primary">提交</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="fixedTools" class="hidden-xs hidden-sm">
  <a id="backtop" class="hidden border-bottom" href="#">Back to top!</a>
  <div class="qrcodeWraper">
    <a><span class="glyphicon glyphicon-qrcode"></span></a>
    <img id="qrcode" class="border" src="//static.segmentfault.com/build/global/img/sf-wechat.27acd26c.png">
  </div>
</div>


<script>
    (function (w) {
        w.SF = {
            staticUrl: "//static.segmentfault.com",
        };
        w.SF.token = (function () {
    var _sdNW3S = 'cb3'//'oTZ'
+//'kia'
'721'+//'1E2'
'2cf'+''///*'w'*/'w'
+''///*'vd'*/'vd'
+/* 'OY'//'OY' */''+'00'//'jJa'
+//'evP'
'd0'+''///*'Rx'*/'Rx'
+//'5Na'
'f'+'3'//'r'
+//'FFW'
'dcb'+//'5NL'
'5NL'+'1'//'mQ'
+'10'//'V1'
+//'CI'
'83'+//'fuW'
'8'+'67e'//'p4'
+/* '7l'//'7l' */''+'2e5'//'4at'
+'0a'//'Z'
, _Pt7 = [[18,21]];

    for (var i = 0; i < _Pt7.length; i ++) {
        _sdNW3S = _sdNW3S.substring(0, _Pt7[i][0]) + _sdNW3S.substring(_Pt7[i][1]);
    }

    return _sdNW3S;
})();
    })(window);
</script>

    <script src="//static.segmentfault.com/build/3rd/assets.ce4fe392.js"></script>
    <script>
    requirejs.config({
        baseUrl: "//static.segmentfault.com/build/global/js"
    });
    </script>
            <script src="//static.segmentfault.com/build/qa/js/question.ef55cf02.js"></script>
    
<script>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-918487-8']);
  _gaq.push(['_trackPageview']);
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-918487-8', 'auto');
  ga('send', 'pageview');

</script>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?e23800c454aa573c0ccb16b52665ac26";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<script src="http://cbjs.baidu.com/js/m.js"></script>
<script>
if(typeof BAIDU_CLB_fillSlotAsync === 'function') {
    BAIDU_CLB_fillSlotAsync('981183','adid-981183');
    BAIDU_CLB_fillSlotAsync('981184','adid-981184');
    BAIDU_CLB_fillSlotAsync('981694','adid-981694');
    BAIDU_CLB_fillSlotAsync('981179','adid-981179');
}
</script>


</body>
</html>
