<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>《神州学人》1987-{{ date('Y') }}全文检索资源管理系统</title>
    @section('style')
        <link rel='stylesheet' href='/common/css/bootstrap.min.css'>
        <link rel='stylesheet' href='/common/css/index/header.css'>
        <link rel='stylesheet' href='/common/css/index/footer.css'>
        <link rel='stylesheet' href='/common/css/index/index.css'>
    @show

    @section('script')
        <script src="/common/js/jquery-3.3.1.min.js"></script>
        <script src="/common/js/bootstrap.min.js"></script>
        <script src="/common/js/index.js"></script>
    @show
</head>

<body>

    <div class="container-fluid two-padding">

        <!--头部Banner start-->
        <div class="row no-margin">
            <div class="col-md-12 gm-banner-img">
                <img class="img-responsive center-block " src="/common/image/banner.png">
            </div>
        </div>
        <!--头部Banner end-->

        <!--搜索 start-->
        <div class="row no-margin">
            <div class="col-md-12 col-xs-12 gm-search-div">
                <div class="col-md-8 col-xs-12 gm-search-font">
                    <a href="/" style="color: white;cursor:pointer;">神州学人</a>
                </div>
                <div class="col-md-4 col-xs-12 gm-search-text">
                    <form class="navbar-form navbar-left" role="search">

                        <div class="input-group">
                            <div class="input-group-btn">
                                <select class="btn form-control" name="type">
                                    <option>全文检索</option>
                                    <option>标题</option>
                                    <option>作者</option>
                                    <option>正文</option>
                                </select>
                            </div><!-- /btn-group -->

                            <input type="text" class="form-control" name="keyword" placeholder="键入关键词  ">
                            <span class="input-group-btn">
                                <button class="btn btn-default gm-search-btn" type="button">Go!</button>
                            </span>
                        </div><!-- /input-group -->

                    </form>
                </div>
            </div>
        </div>
        <!--搜索 end-->

        <!--导航部分start-->
        <nav class="navbar navbar-default">

            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed " data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">按出版年份查看：</a>
                </div>

                <div class="col-md-11 collapse navbar-collapse gm-nav-web" id="bs-example-navbar-collapse-1">
                    <ul class="nav nav-pills">
                        @foreach($navYear as $k=>$item)
                        <li role="presentation" @if(@$year == $item->year_date) class="active" @endif>
                            <a href="/year/{{ $item->year_date }}">{{ $item->year_date }}</a>
                        </li>
                        @endforeach
                        @if(!empty($hiddenYear))
                        <li class="dropdown">
                            <button type="button" class="navbar-toggle wangnian" style="display: block;" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                                往年
                            </button>
                        </li>
                        @endif
                    </ul>
                    @if(!empty($hiddenYear))
                    <div class="col-md-11 collapse gm-nav-web" style="padding: 0;" id="bs-example-navbar-collapse-2">
                        <ul class="nav nav-pills">
                            <li role="presentation"><a href="#">2018年</a></li>
                            <li role="presentation"><a href="#">2017年</a></li>
                            <li role="presentation"><a href="#">2016年</a></li>
                            <li role="presentation"><a href="#">2015年</a></li>
                            <li role="presentation"><a href="#">2014年</a></li>
                            <li role="presentation"><a href="#">2013年</a></li>
                            <li role="presentation"><a href="#">2012年</a></li>
                            <li role="presentation"><a href="#">2011年</a></li>
                            <li role="presentation"><a href="#">2010年</a></li>
                            <li role="presentation"><a href="#">2009年</a></li>
                        </ul>
                    </div>
                    @endif

                </div>
            </div>
        </nav>
        <!--导航部分end-->

        <!--内容 start-->
        <div class="row no-margin">
            @section('content')
                @show
        </div>
        <!--内容 end-->

        <!--底部 start-->
        <div class="col-md-12 gm-footer text-center">
            <div class="col-md-3 col-xs-6 gm-footer-column">
                <span class="glyphicon glyphicon-user pointer"> 关于我们</span>
            </div>
            <div class="col-md-3 col-xs-6 gm-footer-column">
                <span class="glyphicon glyphicon-comment pointer"> 刊物介绍</span>
            </div>
            <div class="col-md-3 col-xs-6 gm-footer-column">
                <span class="glyphicon glyphicon-book pointer"> 神州学人官网</span>
            </div>
            <div class="col-md-3 col-xs-6 gm-footer-column">
                <span class="glyphicon glyphicon-earphone pointer"> 征稿启事</span>
            </div>
        </div>
        <div class="col-md-12 gm-footer-introduce text-center">
            <h3>《神州学人》编辑部 版权所有</h3>
            <p>制作开发：《神州学人》编辑部</p>
        </div>
        <!--底部 end-->

        <!--回到顶部start-->
        <div class="contact text-center">
            <div class="contact-top" title="返回顶部">
                <img src='/common/image/new-top.png' class='img-responsive center-block' />
            </div>
        </div>
        <!--回到顶部end-->
    </div>

</body>

</html>
