@if ($paginator->hasPages())
{{-- Pagination Elemnts --}}
<div id="paginate" class="ui center aligned grid">
    <div class="ui pagination menu">
        @if ($paginator->onFirstPage())
            {{-- First Page View --}}
            <span class="disabled item">
                <i class="angle double left icon"></i>
            </span>
            {{-- Last Page Link --}}
            <span class="disabled item">
                <i class="angle left icon"></i>
            </span>
        @else
            {{-- First Page View --}}
            <a class="item" href="{{ $paginator->url(1) }}">
                <i class="angle double left icon"></i>
            </a>
            {{-- Last Page Link --}}
            <a class="item" href="{{ $paginator->previousPageUrl() }}">
                <i class="angle left icon"></i>
            </a>
        @endif

        {{-- 定数よりもページ数が多い時 --}}
        @if ($paginator->lastPage() > config('const.PAGINATE.LINK_NUM'))

            {{-- 現在ページが表示するリンクの中心位置よりも左の時 --}}
            @if ($paginator->currentPage() <= floor(config('const.PAGINATE.LINK_NUM') / 2))
                <?php $start_page = 1; //最初のページ ?>
                <?php $end_page = config('const.PAGINATE.LINK_NUM'); ?>

            {{-- 現在ページが表示するリンクの中心位置よりも右の時 --}}
            @elseif ($paginator->currentPage() > $paginator->lastPage() - floor(config('const.PAGINATE.LINK_NUM') / 2))
                <?php $start_page = $paginator->lastPage() - (config('const.PAGINATE.LINK_NUM') - 1); ?>
                <?php $end_page = $paginator->lastPage(); ?>

            {{-- 現在ページが表示するリンクの中心位置の時 --}}
            @else
                <?php $start_page = $paginator->currentPage() - (floor((config('const.PAGINATE.LINK_NUM') % 2 == 0 ? config('const.PAGINATE.LINK_NUM') - 1 : config('const.PAGINATE.LINK_NUM'))  / 2)); ?>
                <?php $end_page = $paginator->currentPage() + floor(config('const.PAGINATE.LINK_NUM') / 2); ?>
            @endif

        {{-- 定数よりもページ数が少ない時 --}}
        @else
            <?php $start_page = 1; ?>
            <?php $end_page = $paginator->lastPage(); ?>
        @endif

        {{-- 処理部分 --}}
        @for ($i = $start_page; $i <= $end_page; $i++)
            @if ($i == $paginator->currentPage())
                <span class="active item">{{ $i }}</span>
            @else
                <a class="item" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            @endif
        @endfor

        @if ($paginator->currentPage() == $paginator->lastPage())
            {{-- Next Page Link --}}
            <span class="disabled item">
                <i class="angle right icon"></i>
            </span>
            {{-- Last Page Link --}}
            <span class="disabled item">
                <i class="angle double right icon"></i>
            </span>
        @else
            {{-- Next Page Link --}}
            <a class="item" href="{{ $paginator->nextPageUrl() }}">
                <i class="angle right icon"></i>
            </a>
            {{-- Last Page Link --}}
            <a class="item" href="{{ $paginator->url($paginator->lastPage()) }}">
                <i class="angle double right icon"></i>
            </a>
        @endif
    </div>
</div>
@endif
