@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')
@section('title','ユーザ退会')

@section('content')
<div class="l-main">
    <div class="p-withdraw">
        <div class="p-withdraw__title">
            ユーザー情報を削除します。<br class="sp_only">宜しいですか？
        </div>
        <div class="p-withdraw__action">
            <div class="p-withdraw__delete">
                <form action="{{ route('users.delete',$user->id) }}" method="POST">
                    @csrf
                    <button type="submit">削除</button>
                </form>
            </div>
            <a class="p-withdraw__cansel" href="{{ route('mypage.settings') }}">キャンセル</a>
        </div>

    </div>
</div>
@endsection