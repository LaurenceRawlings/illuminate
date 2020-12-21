<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use App\Models\NewsPost;
use App\Services\GlobalSettings;
use App\Services\NewsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsPostController extends Controller
{
    public function index(Request $request, NewsRepository $newsRepository, GlobalSettings $globalSettings)
    {
        $lastUpdated = $globalSettings->has('lastUpdated') ? Carbon::parse($globalSettings->get('lastUpdated')) : null;
        $updateInterval = $globalSettings->has('updateInterval') ? intval($globalSettings->get('updateInterval')) : 3;

        if (NewsPost::all()->isEmpty() || !$lastUpdated || $lastUpdated->diffInHours() >= $updateInterval) {
            $newsRepository->update();
        }

        $newsPosts = NewsPost::query()->orderByDesc('published_at')->paginate(12);
        $paginatedLinks = InertiaPaginator::paginationLinks($newsPosts);

        return Inertia::render('News/Index', [
            'newsPosts' => $newsPosts,
            'paginated_links' => $paginatedLinks
        ]);
    }
}
