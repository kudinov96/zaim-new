<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $metas["meta_title"] }}</title>
    <meta name="description" content="{{ $metas["meta_description"] }}">
    @if ($metas["meta_keywords"])
        <meta name="keywords" content="{{ $metas["meta_keywords"] }}">
    @endif
    <link rel="stylesheet" href="{{ asset("front/style.css") }}">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo header__logo">
                <a href="/" class="">
                    gidbankov.ru
                </a>
            </div>
            <div class="header__menu">
                <ul>
                    <li>
                        <a href="#">Займы</a>
                    </li>
                    <li>
                        <a href="#">Кредиты</a>
                    </li>
                    <li>
                        <a href="#">Кредитные карты</a>
                    </li>
                    <li>
                        <a href="#">Рефинансирование</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="content-main">
        <div class="container">
            <div class="content-style">
                <h1>{{ $page->title }}</h1>
                {!! $page->content !!}
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="logo footer__logo">
                <a href="/" class="">
                    gidbankov.ru
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
