@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-main">
    <div class="p-mypage" id="js-mypage">
        <users-profile :user='@json($user)' :is-auth-check='@json($user->count()>0)'
            endpoint={{ route('users.edit',$user->id) }}>></users-profile>
        <mypage-tabs current-page="likes"></mypage-tabs>
    </div>
    {{-- 購入アイデア --}}
    <div class="l-mypage__items p-mypage__ideas">
        <div class="p-mypage__ideas__title">気になるリスト一覧</div>
        <div class="p-mypage__ideas__items">
            @if ($likes->count()>0)
            @foreach ($likes as $like)
            <mypage-ideas :idea='@json($like->ideas)' :user='@json($like->ideas->user)'
                endpoint="{{ route('ideas.show',$like->ideas->id) }}" type="likes">
            </mypage-ideas>
            @endforeach
            @else
            <div class="c-mypage__ideas__noitem">現在ありません</div>
            @endif
        </div>
        <div class="c-pagination">
            {{ $likes->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection