@section('header')
<header class="l-header">
    <div class="p-header">
        <div class="p-header__inner">
            <h1 class="p-header__logo">
                <a class="" href="{{ url('/') }}">
                    <img class="p-header__logo__img" src="/images/logo.png" alt="Inspiration">
                </a>
            </h1>
            <nav class="p-header__nav">
                <ul class="p-header__nav__list">
                    @guest
                    <li class="p-header__nav__item p-header__nav__item--login">
                        <a href="/login">ログイン</a>
                    </li>
                    <li class="p-header__nav__item p-header__nav__item--register">
                        <a href="/register">新規登録</a>
                    </li>
                    @endguest
                    @auth
                    <li class="p-header__nav__item">
                        <div class="p-header__icon is-inactive" id="js-drawer__click-target">
                            @if($user->img)
                            <img src="{{ asset('storage/' . $user->img) }}" alt="プロフィール画像" />
                            @else
                            <img src="{{ asset('/images/noavatar.png') }}" alt="{{ $user->name. ' のプロフィール画像' }}">
                            @endif
                        </div>
                        <ul class="p-header__drawer" id="js-drawer__menu">
                            <li class="p-header__drawer__item">
                                <a class="p-header__drawer__link" href="{{ route('users.show',$user->id)}}">マイページ</a>
                            </li>
                            <li class="p-header__drawer__item">
                                <a class="p-header__drawer__link" href="{{ route('ideas.index') }}">アイデア一覧</a>
                                <a class="p-header__drawer__link" href="{{ route('ideas.create') }}">アイデア新規投稿</a>
                            </li>
                            <li class="p-header__drawer__item">
                                <button form="logout-button" type="submit" class="p-header__drawer__link">
                                    ログアウト
                                </button>
                            </li>
                        </ul>
                    </li>
                    <form id="logout-button" method="POST" action="{{ route('logout') }}">
                        @csrf
                    </form>
                    @endauth
                </ul>
            </nav>
        </div>
    </div>
</header>
<div class="p-header__drawer__bg" id="js-drawer__bg"></div>
@endsection