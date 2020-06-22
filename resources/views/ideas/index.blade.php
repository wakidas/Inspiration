@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-main">
    <div class="l-ideas">
        <ideas-search-box ></ideas-search-box>
        <div class="p-ideasList">
            @foreach ($ideas as $idea)
            <ideas-list :idea='@json($idea)' :user='@json($idea->user)' :likesCount='@json($idea->likesCount)'>
            </ideas-list>
            @endforeach
        </div>
    </div>
</div>
@endsection