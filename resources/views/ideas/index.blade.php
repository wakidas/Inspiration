@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-main">
    <div class="l-ideas">
        <div class="p-ideas">
            <ideas-search-box :categories='@json($categories)'></ideas-search-box>
            <div class="p-ideasList">
                @foreach ($ideas as $idea)
                <ideas-list :idea='@json($idea)' :user='@json($idea->user)' :category='@json($idea->category)'
                    :likesCount='@json($idea->likesCount)'>
                </ideas-list>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection