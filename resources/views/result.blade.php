<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>サイトタイトル</title>
<meta name="description" content="サイトキャプションを入力">
<meta name="keywords" content="サイトキーワードを,で区切って入力">
<link rel="stylesheet" href="sample.css">
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<script src="sample.js"></script>
</head>

<body>
<!----- ヘッダー ----->
<header>ヘッダー</header>
<nav>ナビ</nav>
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
</article>
<!----- メインコンテンツ END ----->

<!----- フッター ----->
<footer>フッター</footer>
<!----- フッター END ----->
</body>
</html>
