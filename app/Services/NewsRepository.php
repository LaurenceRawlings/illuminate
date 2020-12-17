<?php


namespace App\Services;


use App\Models\NewsPost;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class NewsRepository
{
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function update()
    {
        $globalSettings = App::make(GlobalSettings::class);

        $response = Http::withHeaders([
            'X-Api-Key' => $this->apiKey,
        ])->get('https://newsapi.org/v2/top-headlines', [
            'country' => 'gb',
            'category' => 'technology',
            'pageSize' => 100,
        ]);

        NewsPost::query()->whereNotNull('id')->delete();

        foreach ($response->json('articles') as $newsPost) {
            (new NewsPost())->fill(array(
                'source' => $newsPost['source']['name'],
                'title' => $newsPost['title'],
                'description' => $newsPost['description'],
                'thumbnail' => $newsPost['urlToImage'],
                'url' => $newsPost['url'],
                'published_at' => Carbon::parse($newsPost['publishedAt']),
            ))->save();
        }

        $globalSettings->set('lastUpdated', now());
    }
}
