@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')
@section('title','ユーザ編集')

@section('content')
<div class="l-main">
    <users-edit :old="{{ json_encode(Session::getOldInput()) }}" :errors="{{ $errors }}"
        endpoint="{{ route('users.update', $user->id) }}" :user='@json($user)'></users-edit>
</div>
@endsection