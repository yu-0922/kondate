<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="description" content="サイトキャプションを入力">
        <meta name="keywords" content="サイトキーワードを,で区切って入力">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/my.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/0722d56e11.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <!----- ヘッダー ----->
    <header><img src="{{ asset('images/freefont_logo_PopRumCute.otf.png') }}">〜働く男のための健康メニュー1週間分〜</header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('top') }}">Top</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li><a class="nav-link" href="{{ route('menu.index') }}">メニュー管理</a></li>
    <li></li>
    </ul>
    </nav>
    <!----- ヘッダー END ----->

    <!----- メインコンテンツ ----->
    <article>
        @if (session()->has("message"))
        <div class="row">
            <div class="border bg-warning text-white">
                <div class="m-3 p-3 border bg-info">{{ session('message') }}</div>
            </div>
        </div>
        @endif

        <h1>@yield('title')</h1>
        <div class="container">
            @yield('content')
        </div>
    </article>
    <!----- メインコンテンツ END ----->

    <!----- フッター ----->
    <footer>&copy; 2021 yusuke all rights reserved.</footer>
    <!----- フッター END ----->

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
