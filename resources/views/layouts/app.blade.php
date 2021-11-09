<!DOCTYPE html>
<html lang="ja" class="h-100 w-100">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="description" content="好きな期間の献立と買い物リストを簡単に作れるアプリ">
        <meta name="keywords" content="献立,買い物リスト,レシピ,買い物,食事,メニュー,１週間">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/my.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/0722d56e11.js" crossorigin="anonymous"></script>
    </head>
    <body class="d-flex flex-column h-100">
    <!----- ヘッダー ----->
        <header>
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="d-flex align-items-center">
                    <a href={{ route('menu.index') }}>
                        <img src="{{ asset('images/freefont_logo_jk-maru-gothic-m.otf.png') }}" class="img-fluid">
                        <img src="{{ asset('images/freefont_logo_jk-maru-gothic-m.otf2.png') }}" class="img-fluid">
                    </a>
                    </div>
                    <div class="d-flex align-items-center">
                        <form method="GET" action="{{ route('menu.index') }}">
                        @csrf
                            <div class="d-flex align-items-center">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-dark my-2 ml-1" type="submit">検索</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('top') }}">Top</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li><a class="nav-link" href="{{ route('menu.index') }}">メニュー一覧</a></li>
        <li><a class="nav-link" href="{{ route('menu.create') }}">メニュー新規登録</a></li>
        <li><a class="nav-link" href="{{ route('category.index') }}">カテゴリ一覧</a></li>
        @if (!\Auth::user())
        <li><a class="nav-link" href="{{ route('register') }}">会員登録</a></li>
        <li><a class="nav-link" href="{{ route('login') }}">ログイン</a></li>
        @else
        <li><a class="nav-link" href="{{ route('logout') }}">ログアウト</a></li>
        @endif
        </ul>
        </nav>
        <!----- ヘッダー END ----->

        <!----- メインコンテンツ ----->
        <article class="flex-shrink-0">
            @if (session()->has("message"))
            <div class="row">
                <div class="ml-4">
                    <div class="m-2 p-2 border border-success bg-light">{{ session('message') }}</div>
                </div>
            </div>
            @endif

            <h1 class="text-center my-5">@yield('title')</h1>
            <div class="container">
                @yield('content')
            </div>
        </article>
        <!----- メインコンテンツ END ----->

        <!----- フッター ----->
        <div class="footer mt-auto py-3">&copy; 2021 yusuke all rights reserved.</div>
        <!----- フッター END ----->

        <script src="https://cdn.jsdelivr.net/npm/bubbly-bg@1.0.0/dist/bubbly-bg.js"></script>
        <script>bubbly();</script>
        <script>
            bubbly({
                colorStart: "#fff4e6",
                colorStop: "#ffe9e4",
                blur: 1,
                compose: "source-over",
                radiusFunc:() => Math.random() * 50,
                bubbleFunc: () => `hsla(${Math.random() * 50}, 100%, 50%, .3)`
            });
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        {{-- 材料・手順追加 --}}
        <script type="text/javascript">
        let inputPlural = document.getElementById('input_plural');
        let inputPlural2 = document.getElementById('input_plural2');

        function add() {
            let div = document.createElement('DIV');
            div.classList.add('d-flex');

            var input = document.createElement('INPUT');
            input.classList.add('form-control');
            input.setAttribute('name', 'ing_name[]');
            div.appendChild(input);

            var input = document.createElement('INPUT');
            input.classList.add('form-control');
            input.setAttribute('name', 'ing_size[]');
            div.appendChild(input);

            var input = document.createElement('INPUT');
            input.setAttribute('type', 'button');
            input.setAttribute('value', '削除');
            input.setAttribute('onclick', 'del(this)');
            div.appendChild(input);

            inputPlural.appendChild(div);
            count++;
        }

        function addStep() {
            let div = document.createElement('DIV');
            div.classList.add('d-flex');

            var input = document.createElement('INPUT');
            input.classList.add('form-control');
            input.setAttribute('name', 'step[]');
            div.appendChild(input);

            var input = document.createElement('INPUT');
            input.setAttribute('type', 'button');
            input.setAttribute('value', '削除');
            input.setAttribute('onclick', 'del(this)');
            div.appendChild(input);

            inputPlural2.appendChild(div);
            count++;
            var_dump(count);
        }

        function del(o) {
            o.parentNode.remove();
        }
        </script>

        {{-- ファイル削除 --}}
        <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
        <script>
            bsCustomFileInput.init();

            document.getElementById('inputFileReset').addEventListener('click', function() {
                bsCustomFileInput.destroy();

                var elem = document.getElementById('inputFile');
                elem.value = '';
                var clone = elem.cloneNode(false);
                elem.parentNode.replaceChild(clone, elem);

                bsCustomFileInput.init();
            });
        </script>

        <script>
            $(function () {
                $('.js-open').click(function () {
                    $('#overlay, .modal-window').fadeIn();
                });
                $('.js-close, #overlay').click(function () {
                    $('#overlay, .modal-window').fadeOut();
                });
            });
        </script>
    </body>
</html>
