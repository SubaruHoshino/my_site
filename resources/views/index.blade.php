@php
    $currentPage = 'index';
@endphp
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>追いかけて</title>
    <link rel="stylesheet" href="{{asset('/css/SemanticUI/semantic.css')}}"/>
    <script src="{{asset('/js/jquery.js')}}"></script>
    <script src="{{asset('/css/SemanticUI/semantic.min.js')}}"></script>
</head>
<body>
    <header>
        <h1 class="ui teal header">
            <i class="snowflake outline icon"></i>
            <div class="content">
                追いかけて
                <div class="sub header">個人の小説サイト</div>
            </div>
        </h1>
    </header>
    <div class="ui teal inverted menu">
        @include('components/menuItem')
    </div>
    <div class="ui main text container">
        <h2 class="ui top attached header">
            <i class="history icon"></i>
            <div class="content">
                更新履歴
            </div>
        </h2>
        <div class="ui attached segment">
            <div class="ui relaxed divided list">
                @foreach ($updateLogs as $row)
                <div class="item">
                    <div class="content">
                        <a class="header" href="{{route('updateLog', ['updateLogId' => $row->id])}}">{{$row->title}}</a>
                        <div class="description">{{date_format(date_create($row->created_at), 'Y/m/d')}} 更新</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="ui bottom attached header right aligned">
            <a href="{{route('updateLogList')}}">更新履歴ログ</a>
        </div>
    </div>
</body>
</html>
