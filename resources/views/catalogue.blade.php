@extends('layout.header')
@section('style')
    @parent
    <link rel='stylesheet' href='/common/css/index/list.css'>
@endsection

@section("content")
		<!--内容 start-->
		<div class="row no-margin">
			<div class="col-md-5 col-xs-12 gm-list-left text-center">
				<img class="img-responsive center-block " src="/ad-upload/{{ $magazine->mimg }}">
				<div class="col-md-6 col-xs-6 gm-left-img">
                    @if(!empty($prov))
                    <a href="/catalogue/{{ $prov->magazine_id }}/date/{{ $date }}">
					    <button type="button" class="btn btn-danger">上一期</button>
                    </a>
                    @endif
				</div>
				<div class="col-md-6 col-xs-6 gm-left-img">
                    @if(!empty($next))
                    <a href="/catalogue/{{ $next->magazine_id }}/date/{{ $date }}">
					    <button type="button" class="btn btn-danger">下一期</button>
                    </a>
                    @endif
				</div>
			</div>
			<div class="col-md-7 col-xs-12 gm-list-right">
				<div class="col-md-12 col-xs-12 gm-list-right1">
					<p>{{ $magazine->page_date }} 《{{ $magazine->subject_name }}》 {{ $magazine->page_name }}</p>
				</div>
				<div class="col-md-12 col-xs-12 gm-list-right2">
                    @foreach($articleList as $k=>$item)
					<div class="col-md-12 col-xs-12 gm-right2-col">
						<div class="col-md-9 col-xs-12">
							<span class="btn btn-danger">&nbsp;{{ $k+1 }}&nbsp;</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="/article/{{ $item->article_id }}/magaid/{{ $item->magazine_id }}" target="_blank">
                                {{ $item->title }}
                            </a>
						</div>
						<div class="col-md-3 col-xs-12">
							<p class="pull-right">{{ $item->author }}</p>
						</div>
					</div>
                    @endforeach


				</div>
			</div>

		</div>
		<!--内容 end-->
@endsection

