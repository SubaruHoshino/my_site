@if (!(isset($currentPage) && $currentPage == 'index'))
<a class="item" href="{{route('index')}}">ホーム</a>
@endif
<a class="{{isset($currentPage) && $currentPage == 'first' ? 'active ' : ''}}item" href="{{route('first')}}">はじめに</a>
<a class="{{isset($currentPage) && $currentPage == 'novel' ? 'active ' : ''}}item" href="{{route('novelList')}}">小説</a>
{{-- <a class="{{isset($currentPage) && $currentPage == 'tool' ? 'active ' : ''}}item">ツール</a> --}}
<a class="{{isset($currentPage) && $currentPage == 'link' ? 'active ' : ''}}item" href="{{route('link')}}">外部リンク</a>
