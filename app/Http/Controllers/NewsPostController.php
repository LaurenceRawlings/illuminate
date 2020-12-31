<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use App\Services\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Inertia\Inertia;
use Inertia\Response;

class NewsPostController extends Controller
{
    public function index(Request $request, NewsRepository $newsRepository): Response
    {
        $page = ($request->has('page')) ? intval($request->page) : 1;
        $collection = collect($newsRepository->latest());

        $newsPosts = new LengthAwarePaginator(
            array_values($collection->forPage($page, 12)->toArray()),
            $collection->count(),
            12,
            $page,
        );

        $newsPosts->setPath(url()->current());

        $paginatedLinks = InertiaPaginator::paginationLinks($newsPosts);

        return Inertia::render('News/Index', [
            'newsPosts' => $newsPosts,
            'paginated_links' => $paginatedLinks
        ]);
    }
}
