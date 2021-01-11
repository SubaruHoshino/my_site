@extends('layouts.app')
@php
    $currentPage = 'link';
@endphp

@section('title')
外部リンク
@endsection

@section('script')
@endsection

@section('breadcrumb')
{{ Breadcrumbs::render('link') }}
@endsection

@section('contents')
<div class="ui list">
    <div class="item">
        <a href="https://nickysp5.wixsite.com/azame">
            <img src={{asset('/image/azame.gif')}} alt="バナー画像" title="azama サイトリンク"/>
            へりさん
            <a>
    </div>
</div>
@endsection
