<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class NewsRepository
{
    private $apiKey;
    private $posts;
    private $lastUpdated;
    private $updateInterval = 3; // 3 hours

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function posts() {
        if (!$this->lastUpdated || !$this->posts || $this->lastUpdated->diffInHours(now()) > $this->updateInterval) {
            $this->updatePosts();
        }


        return $this->posts;
    }

    private function updatePosts()
    {
        $response = Http::withHeaders([
            'X-Api-Key' => $this->apiKey,
        ])->get('https://newsapi.org/v2/top-headlines', [
            'country' => 'gb',
            'category' => 'technology',
            'pageSize' => 100,
        ]);

        $this->posts = $response->json('articles');
        $this->lastUpdated = now();
    }
}
