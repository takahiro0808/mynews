@extends('layouts.profile')

@section('title', 'プロフィール登録')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h1>プロフィール</h1>
                <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-md-2">氏名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">性別</label>
                        <div class="col-md-1">
                            <input type="radio" class="form-control" name="sei" value="男">:男
                            <input type="radio" class="form-control" name="sei" value="女">:女
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">趣味</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">自己紹介欄</label>
                        <div class="col-md-10">
                            <textarea class="form-control-file" name="body" rows="10">{{ old('body')}}</textarea>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection