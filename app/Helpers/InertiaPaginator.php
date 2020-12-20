<?php


namespace App\Helpers;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\UrlWindow;

class InertiaPaginator
{
    static function paginationLinks(LengthAwarePaginator $lengthAwarePaginator)
    {

        $window = UrlWindow::make($lengthAwarePaginator);

        $array = array_filter([
            $window['first'],
            is_array($window['slider']) ? '...' : null,
            $window['slider'],
            is_array($window['last']) ? '...' : null,
            $window['last'],
        ]);

        $i = 1;
        foreach ($array as $index => $urlsArray) {
            if (is_array($urlsArray)) {
                foreach ($urlsArray as $pageNumber => $link) {
                    $currentPage = $lengthAwarePaginator->currentPage();
                    $n[] = [
                        'pageNumber' => $pageNumber,
                        'url' => $link,
                        'indexKey' => $i,
                        'type' => 'URLS',
                        'isCurrentPage' => $currentPage === $pageNumber,
                    ];
                    $i++;
                }
            } elseif (is_string($urlsArray)) {
                $n[] = [
                    'url' => $urlsArray,
                    'indexKey' => $i,
                    'type' => 'ELIPSIS',
                ];
                $i++;
            }
        }


        return count($n) === 1 ? null : $n;
    }
}
