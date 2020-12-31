<?php


namespace App\Services;


use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;

class NewsRepository
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function latest(): array
    {
        try {
            return cache()->remember('news-posts', 60 * 60 * 3, function () {
                $response = Http::withHeaders([
                    'X-Api-Key' => $this->apiKey,
                ])->get('https://newsapi.org/v2/top-headlines', [
                    'country' => 'gb',
                    'category' => 'technology',
                    'pageSize' => 100,
                ]);

                $newsPosts = [];

                foreach ($response->json('articles') as $newsPost) {
                    array_push($newsPosts, array(
                        'source' => $newsPost['source']['name'],
                        'title' => $newsPost['title'],
                        'description' => $newsPost['description'],
                        'thumbnail' => $newsPost['urlToImage'],
                        'url' => $newsPost['url'],
                        'timestamp' => Carbon::parse($newsPost['publishedAt'])->diffForHumans(),
                        'favicon' => $this->favicon($newsPost['url']),
                    ));
                }

                return $newsPosts;
            });
        } catch (Exception $e) {
            return [];
        }
    }

    private function favicon($url): string
    {
        return 'https://www.google.com/s2/favicons?sz=128&domain_url=' . $url;
    }
}
