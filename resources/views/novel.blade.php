@extends('layouts.app')
@php
    $currentPage = 'novel';
    $title = isset($novel->title) ? $novel->title : '存在しない作品';
@endphp

@section('title')
{{$title}}
@endsection

@section('script')
<link rel="stylesheet" href="{{asset('/css/novel.css')}}"/>
@endsection

@section('breadcrumb')
@if (isset($novel))
{{-- 該当する小説が有る場合 --}}
{{ Breadcrumbs::render('novel', $novelType, $novel->id, $title) }}
@endif
@endsection

@section('contents')
@if (!isset($novel))
{{-- 該当する小説が無い場合 --}}
<p>指定された小説はありません</p>
@else
{{-- 該当する小説が有る場合 --}}
<h1 class="ui medium header">
    {{$title}}
    <p class="sub header">{{$novel->info_text}}</p>
    <p class="ui sub header right aligned">{{$date}}</p>
</h1>
<div class="ui divider"></div>
@if ($lockStatus == 1)
{{-- ロック未解除の場合 --}}
<form action="{{url()->current()}}" method="POST">
    @csrf

    <p>
        解除用パスワードを入力してください
    </p>
    <p class="ui input{{$lockError ? ' error' : ''}}">
        <input type="password" name="password" autofocus/>
        <button type="submit" class="ui primary button">入力</button>
    </p>
@if ($lockError)
    <p class="ui error message">
        入力に誤りがあります
    </p>
@endif
</form>
@elseif ($lockStatus == 0 || $lockStatus == 2)
{{-- ロック解除済みの場合 --}}
<p>
<?php echo nl2br(htmlspecialchars($novel->main_text)) ?>
</p>
@endif

{{-- ページ送り --}}
<div id="pager" class="ui center aligned grid">
@if (isset($pager->before_id))
{{-- 前ページが存在する場合 --}}
    <a class="ui left labeled icon teal button" href="{{route('novel', $pager->before_id)}}">
        前へ
        <i class="left arrow icon"></i>
    </a>
@else
{{-- 前ページが存在しない場合 --}}
    <span class="ui left labeled icon teal button disabled">
        前へ
        <i class="left arrow icon"></i>
    </span>
@endif

@if (isset($pager->after_id))
{{-- 次ページが存在する場合 --}}
    <a class="ui right labeled icon teal button" href="{{route('novel', $pager->after_id)}}">
        次へ
        <i class="right arrow icon"></i>
    </a>
@else
{{-- 次ページが存在しない場合 --}}
    <span class="ui right labeled icon teal button disabled">
        次へ
        <i class="right arrow icon"></i>
    </span>
@endif
</div>
@endif
@endsection
