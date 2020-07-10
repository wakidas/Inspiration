@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')
@include('layouts.meta_sns')

@section('content')

<div class="l-main">
    @error('*')
    <flash-message-review></flash-message-review>
    @enderror
    <Ideas-show :idea='@json($idea)' :idea-user='@json($idea->user)' :user-id='@json(Auth::id())'
        :category='@json($idea->category)' :initial-is-liked-by='@json($idea->isLikedBy(Auth::user()))'
        :initial-count-likes='@json($idea->count_likes)' :authorized='@json(Auth::check())'
        endpoint="{{ route('ideas.like', $idea->id) }}" endpoint-buy="{{ route('ideas.buy', $idea->id) }}"
        :initial-is-ordered-by='@json($idea->isOrderedBy(Auth::user()))' :reviews='@json($reviews)'
        :old="{{ json_encode(Session::getOldInput()) }}" :errors="{{ $errors }}"
        endpoint-for-twitter="{{ route('ideas.show',$idea->id) }}"
        :initial-is-reviewed-by='@json($idea->isReviewedBy(Auth::user()))'
        :avg-rate='@json($idea->reviews->avg("rate"))' :review-count='@json($idea->reviews->count())'
        endpoint-idea-user="{{ route('users.show',$idea->user->id) }}"
        endpoint-edit="{{ route('ideas.edit',$idea->id) }}" endpoint-delete="{{ route('ideas.delete',$idea->id) }}"
        :is-ordered-at-least-one='@json($idea->orders->count()>0)'>
    </Ideas-show>
</div>

@endsection