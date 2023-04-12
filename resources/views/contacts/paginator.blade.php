<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php
        if (empty($link_limit)) {
            $link_limit = LINK_LIMIT;
        }
        ?>
        <li class="page-item previous {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link"
                href="{{ $paginator->previousPageUrl() .
                    (request()->filled('company_id') ? '&' . http_build_query(['company_id' => request()->query('company_id')]) : '') .
                    (request()->filled('search') ? '&' . http_build_query(['search' => request()->query('search')]) : '') }}"
                tabindex="-1"><i class="bi bi-chevron-bar-left"></i></a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
                $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)
                <li class="page-item {{ $paginator->currentPage() == $i ? ' active' : '' }}" style="z-index: 0;">
                    <a class="page-link"
                        href="{{ $paginator->url($i) .
                            (request()->filled('company_id') ? '&' . http_build_query(['company_id' => request()->query('company_id')]) : '') .
                            (request()->filled('search') ? '&' . http_build_query(['search' => request()->query('search')]) : '') }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <li class="page-item next {{ $paginator->lastPage() == $paginator->currentPage() ? 'disabled' : '' }}">
            <a class="page-link"
                href="{{ $paginator->nextPageUrl() .
                    (request()->filled('company_id') ? '&' . http_build_query(['company_id' => request()->query('company_id')]) : '') .
                    (request()->filled('search') ? '&' . http_build_query(['search' => request()->query('search')]) : '') }}"><i
                    class="bi bi-chevron-bar-right"></i></a>
        </li>
    </ul>
</nav>
