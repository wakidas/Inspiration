@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')
@section('title','ユーザーページ')

@section('content')
<div class="l-main">
    <div class="p-usersShow">
        <users-profile :user='@json($this_user)' :is-auth-check='@json($isAuthCheck)'
            endpoint={{ route('users.edit',$user->id) }}>></users-profile>
        <section class="p-ideasList" id="js-ideas-list">
            <div class="p-ideasList__title">投稿アイデア一覧</div>
            <div class="p-ideasList__inner">
                @foreach ($ideas as $idea)
                <ideas-list :idea='@json($idea)' :user='@json($idea->user)' :category='@json($idea->category)'
                    :likes-count='@json($idea->likesCount)' endpoint='{{route('ideas.show',$idea->id)}}'
                    :avg-rate='@json($idea->reviews->avg("rate"))' :review-count='@json($idea->reviews->count())'>
                </ideas-list>

                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection