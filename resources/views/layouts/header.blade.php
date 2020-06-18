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
                            <img src="{{ asset('storage/' . $user->profile_phot) }}" alt="プロフィール画像" />
                            @else
                            <img src="{{ asset('/images/noavatar.png') }}" alt="{{ $user->name. ' のプロフィール画像' }}">
                            @endif
                        </div>
                        <ul class="p-header__drawer" id="js-drawer__menu">
                            <li class="p-header__drawer__item">
                                <a class="p-header__drawer__link" href="">マイページ</a>
                            </li>
                            <li class="p-header__drawer__item">
                                <a class="p-header__drawer__link" href="">アイデア一覧</a>
                                <a class="p-header__drawer__link" href="">アイデア投稿一覧</a>
                            </li>
                            <li class="p-header__drawer__item">
                                <button form="logout-button" type="submit" class="p-header__drawer__link">
                                    ログアウト
                                </button>
                            </li>
                        </ul>
                    </li>
                    <form id="logout-button" method="POST" action="{{ route('logout') }}"> {{--この行を編集--}}
                        @csrf {{--この行を追加--}}
                    </form>
                    @endauth
                </ul>
            </nav>
            {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
            </ul>
        </div> --}}
    </div>
    </div>
</header>
<div class="p-header__drawer__bg" id="js-drawer__bg"></div>
@endsection