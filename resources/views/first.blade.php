@extends('layouts.app')
@php
    $currentPage = 'first';
@endphp

@section('title')
はじめに
@endsection

@section('script')
<script src="{{asset('/js/user/first.js')}}"></script>
@endsection

@section('breadcrumb')
{{ Breadcrumbs::render('first') }}
@endsection

@section('contents')
<h2 class="ui dividing header">このサイトについて</h2>
<p>
    このサイトは星野昴が管理するサイトです。<br>
    非公式のファンサイトで、公式とは関係ありません。
</p>
<p>
    連絡先は下記のものになります。<br>
    　mail - <span id="target"></span><br>
    　Twitter - <span id="testes"></span>
</p>
<h2 class="ui dividing header">鍵マーク付きの話について</h2>
<p>
    鍵マークが付いている話は年齢制限ありの話となっております。<br>
    18歳以上の方のみパスワードを入力してご閲覧ください。ただし、18歳でも高校生の方の閲覧はご遠慮ください。<br>
</p>
<p>
    <style>
        .transparent {
            visibility: hidden;
        }
    </style>
    <button id="btnShowPass" class="ui teal button">閲覧条件を満たしています</button><br>
    パスワードは<br>
    <span id="pass" class="transparent">{{$password}}</span><br>
    です。
</p>
@endsection
