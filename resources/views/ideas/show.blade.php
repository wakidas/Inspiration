@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')

<div class="l-main">
    @error('*')
    <flash-message-review></flash-message-review>
    @enderror
    <Ideas-show :idea='@json($idea)' :user-id='@json(Auth::id())' :category='@json($idea->category)'
        :initial-is-liked-by='@json($idea->isLikedBy(Auth::user()))' :initial-count-likes='@json($idea->count_likes)'
        :authorized='@json(Auth::check())' endpoint="{{ route('ideas.like', $idea->id) }}"
        endpoint-buy="{{ route('ideas.buy', $idea->id) }}"
        :initial-is-ordered-by='@json($idea->isOrderedBy(Auth::user()))' :reviews='@json($reviews)'
        :old="{{ json_encode(Session::getOldInput()) }}" :errors="{{ $errors }}">
    </Ideas-show>
</div>

@endsection