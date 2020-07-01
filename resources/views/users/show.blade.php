@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-main">
    <div class="p-usersShow">
        <users-profile :user='@json($this_user)' :is-auth-check='@json($isAuthCheck)'
        endpoint={{ route('users.edit',$user->id) }}>></users-profile>
        <div class="p-ideasList">
            @foreach ($ideas as $idea)
            <ideas-list :idea='@json($idea)' :user='@json($idea->user)' :category='@json($idea->category)'
                :likes-count='@json($idea->likesCount)' endpoint='{{route('ideas.show',$idea->id)}}'
                :avg-rate='@json($idea->reviews->avg("rate"))' :review-count='@json($idea->reviews->count())'
                >
            </ideas-list>

            @endforeach
        </div>
    </div>
</div>
@endsection