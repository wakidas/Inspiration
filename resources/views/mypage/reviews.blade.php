@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-main">
    <div class="p-mypage" id="js-mypage">
        <users-profile :user='@json($user)' :is-auth-check='@json($user->count()>0)'
            endpoint={{ route('users.edit',$user->id) }}>></users-profile>
        <mypage-tabs current-page="reviews"></mypage-tabs>
    </div>
    {{-- レビュー一覧 --}}
    <div class="p-mypage__reviews">
        <div class="p-mypage__reviews__title">投稿されたレビュー一覧</div>
        <div class="p-mypage__reviews__items">
            @foreach ($reviews as $review)
            <mypage-reviews :review='@json($review)' :user='@json($review->user)'
                endpoint="{{ route('ideas.show',$review->id) }}" type="review">
            </mypage-reviews>
            @endforeach
        </div>
    </div>
</div>
@endsection