<!DOCTYPE html>
<html lang="ja">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/css/SemanticUI/semantic.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/common.css')}}"/>
    <script src="{{asset('/js/jquery.js')}}"></script>
    <script src="{{asset('/css/SemanticUI/semantic.min.js')}}"></script>
@yield('script')
</head>
<body>
    <div class="ui top fixed teal inverted menu">
        @include('components/menuItem')
    </div>
    <div class="ui main text container">
@yield('breadcrumb')
@yield('contents')
    </div>
</body>
</html>
