<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use App\Services\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Inertia\Inertia;

class NewsController extends Controller
{
    public function index(Request $request, NewsRepository $newsRepository)
    {
        $page = ($request->has('page')) ? intval($request->page) : 1;
        $collection = collect($newsRepository->posts());
        $posts = new LengthAwarePaginator(
            array_values($collection->forPage($page, 12)->toArray()),
            $collection->count(),
            12,
            $page,
        );

        $posts->setPath(url()->current());

        $paginatedLinks = InertiaPaginator::paginationLinks($posts);

        return Inertia::render('News', [
            'posts' => $posts,
            'paginated_links' => $paginatedLinks
        ]);
    }
}
