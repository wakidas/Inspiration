@extends('layouts.app')
@section('title','ユーザー登録')
@section('description','ユーザー登録　新規登録　そのアイデア、形にしませんか？「Webサービスのアイデアはあるけど、実装スキルがない」「実装スキルはあるけど、サービスのアイデアはない」Webサービスアイデア販売プラットフォーム　Inspiration')

@section('content')
<div class="l-register">
    <register-form :old="{{ json_encode(Session::getOldInput()) }}" :errors="{{ $errors }}"
        endpoint-register="{{ route('register') }}">
    </register-form>
</div>
@endsection