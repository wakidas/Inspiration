@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')

<div class="l-main">
    <Ideas-show :idea='@json($idea)' :user-id='@json($user->id)' :category='@json($idea->category)'
        :initial-is-liked-by='@json($idea->isLikedBy(Auth::user()))' :initial-count-likes='@json($idea->count_likes)'
        :authorized='@json(Auth::check())' endpoint="{{ route('ideas.like', $idea->id) }}"
        endpoint-buy="{{ route('ideas.buy', $idea->id) }}"
        :initial-is-ordered-by='@json($idea->isOrderedBy(Auth::user()))' :reviews='@json($reviews)'>
    </Ideas-show>
</div>

@endsection