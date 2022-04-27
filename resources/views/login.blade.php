@extends('layout.header')
@section('style')
    @parent
    <link rel='stylesheet' href='/common/css/index/index.css'>
@endsection

@section("content")
<!--内容 start-->
<div class="row no-margin" style="min-height: 300px;">
    <div class="col-md-4 col-md-offset-4" >
        <form action="/login/submit" method="post">
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
<!--内容 end-->
@endsection
