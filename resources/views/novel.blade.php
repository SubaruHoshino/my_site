@extends('layouts.app')
@php
    $currentPage = 'novel';
@endphp

@section('title')
小説一覧
@endsection

@section('breadcrumb')
{{-- {{ Breadcrumbs::render('novel') }} --}}
@endsection

@section('contents')
<h1 class="ui medium header">
    Account Settings
    <p class="sub header">Manage your account settings and set e-mail preferences.</p>
    <p class="ui sub header right aligned">2020/08/08</p>
</h1>
<div class="ui divider"></div>
<p class="">
    あめんぼあかいなあいうえお<br/>
    あめんぼあかいなあいうえお<br/>
    あめんぼあかいなあいうえお<br/>
</p>
<div class="ui center aligned grid">
    <span class="ui left labeled icon teal button disabled">
        前へ
        <i class="left arrow icon"></i>
    </span>
    <a class="ui right labeled icon teal button">
        次へ
        <i class="right arrow icon"></i>
    </a>
</div>
@endsection
