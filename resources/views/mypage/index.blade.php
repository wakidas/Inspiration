@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')
@section('title','マイページ')

@section('content')
<div class="l-main">
    <div class="l-mypage__items p-mypage" id="js-mypage">
        <users-profile :user='@json($user)' :is-auth-check='@json($user->count()>0)'
            endpoint={{ route('users.edit',$user->id) }}>></users-profile>
        <mypage-tabs current-page="index"></mypage-tabs>
        {{-- 購入アイデア --}}
        <div class="p-mypage__ideas">
            <div class="p-mypage__ideas__title">購入アイデア(最新5件表示)<span class="p-mypage__ideas__toAll"><a
                        href="{{ route('mypage.boughts') }}">>>全件表示</a></span></div>
            <div class="p-mypage__ideas__items">
                @if ($boughts->count()>0)
                @foreach ($boughts as $bought)
                <mypage-ideas :idea='@json($bought->ideas)' :user='@json($bought->ideas->user)'
                    endpoint="{{ route('ideas.show',$bought->ideas->id) }}" type="bought">
                </mypage-ideas>
                @endforeach
                @else
                <div class="c-mypage__ideas__noitem">現在ありません</div>
                @endif
            </div>
        </div>
        {{-- お気に入り --}}
        <div class="p-mypage__ideas">
            <div class="p-mypage__ideas__title">気になるリスト(最新5件表示)<span class="p-mypage__ideas__toAll"><a
                        href="{{ route('mypage.likes') }}">>>全件表示</a></span></div>
            <div class="p-mypage__ideas__items">
                @if ($likes->count()>0)
                @foreach ($likes as $like)
                <mypage-ideas :idea='@json($like->ideas)' :user='@json($like->ideas->user)'
                    endpoint="{{ route('ideas.show',$like->ideas->id) }}" type="likes"
                    endpoint-like="{{ route('ideas.like', $like->ideas->id) }}">
                </mypage-ideas>
                @endforeach
                @else
                <div class="c-mypage__ideas__noitem">現在ありません</div>
                @endif
            </div>
        </div>
        {{-- 投稿したアイデア --}}
        <div class="p-mypage__ideas">
            <div class="p-mypage__ideas__title">投稿したアイデア(最新5件表示)<span class="p-mypage__ideas__toAll"><a
                        href="{{ route('mypage.myIdeas') }}">>>全件表示</a></span></div>
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
        </div>
        {{-- レビュー一覧 --}}
        <div class="p-mypage__reviews">
            <div class="p-mypage__reviews__title">投稿されたレビュー(最新5件表示)<span class="p-mypage__reviews__toAll"><a
                        href="{{ route('mypage.reviews') }}">>>全件表示</a></span></div>
            <div class="p-mypage__reviews__items">
                @if ($reviews->count()>0)
                @foreach ($reviews as $review)
                <mypage-reviews :review='@json($review)' :user='@json($review->idea->user)'
                    endpoint="{{ route('ideas.show',$review->idea->id) }}" type="review">
                </mypage-reviews>
                @endforeach
                @else
                <div class="c-mypage__ideas__noitem">現在ありません</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection