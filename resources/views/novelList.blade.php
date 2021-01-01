@extends('layouts.app')
@php
    $currentPage = 'novel';
@endphp

@section('title')
小説一覧
@endsection

@section('breadcrumb')
{{ Breadcrumbs::render('novelList') }}
@endsection

@php
$dummyId = -1;
$beforeId = $dummyId;
@endphp

@section('contents')
<div class="ui celled list">
    @foreach ($list as $novel)
        @if ($novel->title_id != $beforeId)

            @if ($dummyId != $beforeId)
                </div>
            </div>
            @endif
            <div class="item">
                <div class="header">{{$novel->novels_title}}</div>
                <div class="description">{{$novel->description}}</div>
                <div class="list">
        @endif
                    <a class="item" href="{{route('novel', ['novelId' => $novel->novel_id])}}">{{$novel->novel_title}}</a>
        @php
            $beforeId = $novel->title_id;
        @endphp
    @endforeach
</div>
</div>
</div>
@endsection
