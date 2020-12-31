@extends('layouts.app')
@section('title')
更新履歴
@endsection

@section('breadcrumb')
{{ Breadcrumbs::render('updateLog', $updateLog) }}
@endsection

@section('contents')
<h1 class="ui block header">
    {{$updateLog->title}}
</h1>
<div class="ui dividing sub header right aligned">
    {{date_format(date_create($updateLog->created_at), 'Y/m/d')}}
</div>
<p>
    @php echo nl2br(htmlspecialchars($updateLog->comment));  @endphp
</p>
@endsection
