@extends('layouts.app')
@section('title')
更新履歴一覧
@endsection

@section('breadcrumb')
{{ Breadcrumbs::render('updateLogList') }}
@endsection

@section('contents')
<h2 class="ui top attached header">
    <i class="history icon"></i>
    <div class="content">
        更新履歴一覧
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
{{$paginator->links('components/pager')}}
@endsection
