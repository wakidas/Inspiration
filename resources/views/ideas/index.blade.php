@extends('layouts.app')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="l-main">
    <div class="l-ideas">
        <section class="p-ideas__searchBox">
            <ideas-search-box :categories='@json($categories)' endpoint='{{ route('ideas.index') }}'
                :post-data='@json($postData)'></ideas-search-box>
        </section>
        <section class="p-ideasList" id="js-ideas-list">
            <div class="p-ideasList__title">一覧 / 検索結果</div>
            <div class="p-ideasList__inner">
                @if($ideas->count() > 0)
                @foreach ($ideas as $idea)
                <ideas-list :idea='@json($idea)' :user='@json($idea->user)' :category='@json($idea->category)'
                    :likes-count='@json($idea->count_likes)' endpoint='{{route('ideas.show',$idea->id)}}'
                    :avg-rate='@json($idea->reviews->avg("rate"))' :review-count='@json($idea->reviews->count())'>
                </ideas-list>
                @endforeach
                @else
                <div class="p-ideasList__noItem">条件に合うアイデアはありません</div>
                @endif
            </div>
            <div class="c-pagination">
                {{ $ideas->appends(request()->input())->links() }}
            </div>
        </section>
    </div>
</div>
@endsection