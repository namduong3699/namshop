<?php
// config
$link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($paginator->lastPage() > 1)
    <ul class="pagination">
        <li class="page-item {{ ($paginator->currentPage() == 1) ? 'active' : '' }}">
            <a href="page-link {{ $paginator->url(1) }}">Đầu</a>
         </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if($i === 0)

            @endif
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
                <li class="page-item {{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
                    <a href="page-link {{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'active' : '' }}">
            <a href="page-link {{ $paginator->url($paginator->lastPage()) }}">Cuối</a>
        </li>
    </ul>
@endif

<style>
    .page-item.active .page-link {
    /*background-color: #57606f;
    border-color: #57606f;*/
    background-color: #999;
    border-color: #999;
    color: #fff;
  }
  .page-link {
    /*color: #1e90ff;*/
    font-family: Poppins-Regular;
    font-size: 14px;
    color: #808080;

    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: 1px solid #e6e6e6;
    margin: 7px;
    justify-content: center;
    -ms-align-items: center;
    align-items: center;
    text-align: center;

    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
  }
  .page-link:hover {
    background-color: #999;
    border-color: #999;
    color: #fff;
  }
  .page-item:first-child .page-link {
    border-radius: 50%;
  }
  .page-item:last-child .page-link {
    border-radius: 50%;
  }
</style>