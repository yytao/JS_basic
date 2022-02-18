@extends('layout.header')
@section('style')
    @parent
    <link rel='stylesheet' href='/common/css/index/content.css'>
@endsection

@section("content")
    <!--内容 start-->
    <div class="row no-margin">

        <div class="col-md-9 col-xs-12 gm-content-left">
            <h1 class="gm-title">
                {{ $article->title }}
            </h1>
            <h3 class="gm-subtitle">
                @if(!empty($article->subtitle))
                    <small>副标题：{{ $article->subtitle }}</small><br/><br/>
                @endif

                @if(!empty($article->source))
                    <small>来源：{{ $article->source }}</small><br/><br/>
                @endif
                <small>{{ $magazine->page_date }} {{ $magazine->subject_name }} {{ $magazine->page_name }}&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="glyphicon glyphicon-volume-up gm-horn"></span>
                </small>
            </h3>
            <div style="font-size: 16px;">
                {!! $article->content !!}
            </div>

        </div>

        <div class="col-md-3 col-xs-12 gm-content-right">
            <h4>本期目录</h4>
            @foreach($articleList as $k=>$item)
            <p>
                <span class="gm-num">{{ $k+1 }}</span>
                <span class="gm-text">
                    <a href="/article/{{ $item->article_id }}/magaid/{{ $item->magazine_id }}" target="_blank">
                        {{ $item->title }}
                    </a>
                </span>
            </p>
            @endforeach


        </div>
    </div>
    <!--内容 end-->
@endsection
