@extends('layout.header')
@section('style')
    @parent
    <link rel='stylesheet' href='/common/css/index/search.css'>
@endsection

@section("content")
    <!--内容 start-->
    <div class="row no-margin content">

        <h1>
            检索结果：
        </h1>

        <div class="col-xs-12 gm-content-left">
            @foreach($result as $k=>$item)
            <div class="searchItem">
                <h3 class="gm-title">
                    {!! $item->title !!}
                </h3>
                <h3 class="gm-title">
                    <small>{{ $item->magazine->subject_name.' '.$item->magazine->year.'年 '.$item->magazine->page_name }}</small>
                </h3>
                <h3 class="gm-subtitle">
                    <small>{!! ($item->contentSubstr) !!}</small>
                </h3>
            </div>
            @endforeach
        </div>

        <div class="paginate" style="text-align: center;">
            {{ $result->render('layout/paginate') }}
        </div>
    </div>
    <!--内容 end-->
@endsection
