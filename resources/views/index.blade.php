@extends('layout.header')
@section('style')
    @parent
    <link rel='stylesheet' href='/common/css/index/index.css'>
@endsection

@section("content")
<!--内容 start-->
<div class="row no-margin">

    <div class="col-md-12 gm-content">
    @foreach($magazine as $k=>$item)

        @if(($k+1)%4 == 0)
            </div>
            <div class="col-md-12 gm-content">
        @endif
        <div class="col-md-3 no-padding gm-content-son">
            <div class="col-md-12 gm-content-title">{{ $item['page_name'] }}</div>
            <div class="col-md-12 gm-content-img text-center">
                <a href="/catalogue/{{ $item['magazine_id'] }}/date/{{ $item['page_date'] }}">
                    <img class="img-responsive center-block " src="/ad-upload/{{ $item['mimg'] }}">
                </a>
                <div class="col-md-6 col-xs-6 gm-img-btn">
                    <a href="/catalogue/{{ $item['magazine_id'] }}/date/{{ $item['page_date'] }}">
                        <button type="button" class="btn btn-danger">查看目录</button>
                    </a>
                </div>
                <div class="col-md-6 col-xs-6 gm-img-btn">
                    <a href="/aetherupload/display/{{ $item['pdf_file'] }}" target="_blank">
                        <button type="button" class="btn btn-danger">版式阅读</button>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>



</div>
<!--内容 end-->
@endsection
