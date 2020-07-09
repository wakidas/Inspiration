@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-main">
    <div class="p-mypage" id="js-mypage">
        <users-profile :user='@json($user)' :is-auth-check='@json($user->count()>0)'
            endpoint={{ route('users.edit',$user->id) }}>></users-profile>
        <mypage-tabs current-page="bought"></mypage-tabs>
    </div>
    {{-- 購入アイデア --}}
    <div class="l-mypage__items p-mypage__ideas">
        <div class="p-mypage__ideas__title">購入アイデア一覧</div>
        <div class="p-mypage__ideas__items">
            @foreach ($boughts as $bought)
            <mypage-ideas :idea='@json($bought->ideas)' :user='@json($bought->ideas->user)'
                endpoint="{{ route('ideas.show',$bought->ideas->id) }}" type="bought">
            </mypage-ideas>
            @endforeach
        </div>
        <div class="c-pagination">
            {{ $boughts->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection