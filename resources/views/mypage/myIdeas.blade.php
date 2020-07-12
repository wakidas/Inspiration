@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')
@section('title','マイページ')

@section('content')
<div class="l-main">
    <div class="p-mypage" id="js-mypage">
        <users-profile :user='@json($user)' :is-auth-check='@json($user->count()>0)'
            endpoint={{ route('users.edit',$user->id) }}>></users-profile>
        <mypage-tabs current-page="myIdeas"></mypage-tabs>
    </div>
    {{-- 投稿したアイデア --}}
    <div class="l-mypage__items p-mypage__ideas">
        <div class="p-mypage__ideas__title">投稿したアイデア一覧</div>
        <div class="p-mypage__ideas__items">
            @if ($myIdeas->count()>0)
            @foreach ($myIdeas as $myIdea)
            <mypage-ideas :idea='@json($myIdea)' :user='@json($myIdea->user)'
                endpoint="{{ route('ideas.show',$myIdea->id) }}" type="myIdeas">
            </mypage-ideas>
            @endforeach
            @else
            <div class="c-mypage__ideas__noitem">現在ありません</div>
            @endif
        </div>
        <div class="c-pagination">
            {{ $myIdeas->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection