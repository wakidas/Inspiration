@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')
@section('title','マイページ')

@section('content')
<div class="l-main">
    <div class="p-mypage" id="js-mypage">
        <users-profile :user='@json($user)' :is-auth-check='@json($user->count()>0)'
            endpoint={{ route('users.edit',$user->id) }}>></users-profile>
        <mypage-tabs current-page="reviews"></mypage-tabs>
    </div>
    {{-- レビュー一覧 --}}
    <div class="l-mypage__items p-mypage__reviews">
        <div class="p-mypage__reviews__title">投稿されたレビュー一覧</div>
        <div class="p-mypage__reviews__items">
            @if ($reviews->count()>0)
            @foreach ($reviews as $review)
            <mypage-reviews :review='@json($review)' :user='@json($review->user)'
                endpoint="{{ route('ideas.show',$review->idea->id) }}" type="review">
            </mypage-reviews>
            @endforeach
            @else
            <div class="c-mypage__ideas__noitem">現在ありません</div>
            @endif
        </div>
        <div class="c-pagination">
        </div>
    </div>
</div>
@endsection