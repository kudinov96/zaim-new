<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("meta_title", $metas["meta_title"] ?? "")</title>
    <meta name="description" content="@yield("meta_description", $metas["meta_description"] ?? "")">
    @if (isset($metas) && $metas["meta_keywords"])
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

            @if($options->has("menu"))
                <div class="header__menu">
                    <ul>
                        @foreach($options["menu"] as $menu_item)
                            <li @if($site_path === $menu_item["link"]) class="active" @endif>
                                <a href="/{{ $menu_item["link"] }}">{{ $menu_item["text"] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </header>

    <div class="content-main">
        <div class="container">
            <div class="content-style">
                @yield("content")
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
