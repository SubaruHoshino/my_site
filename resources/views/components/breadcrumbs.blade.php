@if (count($breadcrumbs))
<div class="ui breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && !$loop->last)
            <a class="section" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
            <i class="right angle icon divider"></i>
        @else
            <div  class="active section">{{ $breadcrumb->title }}</div >
        @endif
    @endforeach
</div>
@endif
