<!DOCTYPE html>
<html lang="ja">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/css/SemanticUI/semantic.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/common.css')}}"/>
    <script src="{{asset('/css/SemanticUI/semantic.min.js')}}"></script>
</head>
<body>
    <div class="ui top fixed teal inverted menu">
        <a class="item" href="/">トップ</a>
        <a class="item">はじめに</a>
        <a class="active item" href="./novelMain.html">小説</a>
        <a class="item">ツール</a>
        <a class="item">外部リンク</a>
    </div>
    <div class="ui main text container">
@yield('breadcrumb')
@yield('contents')
    </div>
</body>
</html>
