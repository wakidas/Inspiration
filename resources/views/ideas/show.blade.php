@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')

<div class="l-main">
    <Ideas-show :idea='@json($idea)' :category='@json($idea->category)'></Ideas-show>
</div>

@endsection