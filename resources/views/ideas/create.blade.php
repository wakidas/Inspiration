@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-main">
    <div class="l-create">
        <div class="p-create">
            <ideas-form :old="{{ json_encode(Session::getOldInput()) }}" :errors="{{ $errors }}"
                endpoint="{{ route('ideas.store') }}" :categories='@json($categories)'></ideas-form>
        </div>
    </div>
</div>
@endsection