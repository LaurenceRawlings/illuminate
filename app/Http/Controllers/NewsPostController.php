<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use App\Models\NewsPost;
use App\Services\GlobalSettings;
use App\Services\NewsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Inertia\Inertia;

class NewsPostController extends Controller
{
    public function index(Request $request, NewsRepository $newsRepository)
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
