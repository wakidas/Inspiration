@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')

<div class="l-main">
    <Ideas-show :idea='@json($idea)' :category='@json($idea->category)'
        :initial-is-liked-by='@json($idea->isLikedBy(Auth::user()))' :initial-count-likes='@json($idea->count_likes)'
        :authorized='@json(Auth::check())' endpoint="{{ route('ideas.like', $idea->id) }}"></Ideas-show>
</div>

@endsection