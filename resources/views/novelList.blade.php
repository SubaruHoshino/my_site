@extends('layouts.app')
@php
    $currentPage = 'novel';
@endphp

@section('title')
小説一覧
@endsection

@section('script')
<script src="{{asset('/js/user/novelList.js')}}"></script>
@endsection

@section('breadcrumb')
{{ Breadcrumbs::render('novelList', null) }}
@endsection

@php
$dummyId = -1;
$beforeId = $dummyId;
$firstFlag = true;
@endphp

@section('contents')
{{-- タブメニュー --}}
<div class="ui top attached tabular menu">
    @foreach ($novelType as $key => $type)
        <a id="{{$type->type_code}}" class="{{$type->type_code == $novelTypeCode ? 'active ' : ''}}item" href="{{route('novelList', ['novelTypeCode' => $type->type_code])}}">
            {{$type->type_name}}
        </a>
    @endforeach
</div>
<div class="ui bottom attached segment">
{{-- 小説一覧 --}}
    <div class="ui celled list">
@foreach ($novelList as $novel)
@if ($beforeId != $novel->title_id)
@if ($beforeId != $dummyId)
            </div>
        </div>
@endif
        <div class="item">
            <div class="header">{{$novel->novels_title}}</div>
            <div class="description">{{$novel->description}}</div>
            <div class="list">
@endif
                <a class="item" href="{{route('novel', $novel->novel_id)}}">{{$novel->novel_title}}<?php
                    if ($novel->lock_id != 0) {
                        echo ' <i class="lock icon teal"></i>';
                    }
                ?></a>
@php
    $beforeId = $novel->title_id;
@endphp
@endforeach
            </div>
        </div>
    </div>
</div>
@endsection
